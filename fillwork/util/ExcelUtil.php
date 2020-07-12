<?php
namespace fillwork\util;

use \PHPExcel;
use \PHPExcel_IOFactory;
use \PHPExcel_Style_Alignment;
use \PHPExcel_Shared_Font;
use \PHPExcel_Style_Fill;
use \PHPExcel_Style_Border;

class ExcelUtil {
	private $excel = null;
	private static $instance = null;
	private $extension;
	// 全局设置
	private $sys = [
		'filename' => 'Excel Document',
		'type' => 'Excel5'
	];

	/**
	 * 文档信息
	 * 可修改的信息字段
	 * 'creater' => 'Envid',
	 * 'lastModifiedBy' => 'Envid',
	 * 'title' => 'Demo Spreadsheet',
	 * 'subject' => 'Office 2007 XLSX',
	 * 'description' => 'Demo Document generated using PHP classes.',
	 * 'keywords' => 'Office 2007 OpenXML PHP',
	 * 'category' => 'Demo Document',
	 * 'manager' => 'Envid'
	 */
	private $attr = [];
	/**
	 * 默认样式
	 * 可用的样式名称
	 * border
	 * font
	 * alignment
	 * color
	 * fill
	 * allborders
	 */
	private $global = [
		'font' => [
			'name' => '黑体',
			'size' => 12
		],
		'alignment' => [
			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
			'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
		]
	];
	// 自定义样式（参照默认样式）
	private $styleArr = [];

	// 禁止实例化
	final private function __construct($config, $attr, $style) {
		$this->sys = array_merge($this->sys, $config);
		$this->attr = array_merge($this->attr, $attr);
		$this->styleArr = array_merge($this->styleArr, $style);
		$this->getExt();
		$this->initialize();
	}
	// 禁止克隆
	final private function __clone(){}

	// 初始化
	private function initialize() {
		$this->excel = new PHPExcel();
		// 设置全局默认样式
		$style = $this->excel->getDefaultStyle()->applyFromArray($this->global);
		// 设置用户信息
		$attr = $this->excel->getProperties();
		$attr->setCreator($this->attr['creater']);
		$attr->setLastModifiedBy($this->attr['lastModifiedBy']);
		$attr->setTitle($this->attr['title']);
		$attr->setSubject($this->attr['subject']);
		$attr->setDescription($this->attr['description']);
		$attr->setKeywords($this->attr['keywords']);
		$attr->setCategory($this->attr['category']);
		$attr->setManager($this->attr['manager']);
	}

	// 获取实例
	public static function getInstance($config=[], $attr=[], $style=[]) {
		if (!self::$instance instanceof self) {
			self::$instance = new self($config, $attr, $style);
		}
		return self::$instance;
	}

	/**
	 * 创建Excel
	 * @param    integer    $eCount sheet个数
	 * @param    string     $title  Sheet名称
	 * @param    array     $fields 字段名
	 * @param    array     $data   数据
	 */
	public function createExcel($eCount=1, $title, $fields, $data) {
		for ($i=1; $i <= $eCount; $i++) { 
			if ($eCount  > 1) $this->excel->createSheet();
			$this->excel->setActiveSheetIndex($i-1);
			$actSheet = $this->excel->getActiveSheet();
			$actSheet->setTitle($title.$i);
			// 方案一（推荐）
			$start = 1;
			foreach ($data as $row) {
				foreach ($fields as $index=>$field){
					// 表头样式
					if ($start==1){
						$actSheet->getStyle($this->getCells($index).$start)->applyFromArray($this->styleArr);
					}
					// 设置宽度
					if(($len = strlen($row[$field])) > 5){
						$len = ceil($len*1.1);
						$actSheet->getColumnDimension($this->getCells($index))->setWidth($len);
					}
					$actSheet->setCellValue($this->getCells($index).$start,$row[$field]);
				}
				$start++;
			}
			/**
			 * 方案二（不推荐）
			 * 使用$actSheet->fromArray($data);
			 * 原因：
			 * 1. 直接通过该函数写入文件，虽省代码，但耗内存资源
			 * 2. 不能自定义样式
			 **/
		}

		// 浏览器输出
		$this->browserExport();
	}


	// 根据下标获取单元格
	private function getCells($index) {
		$cell = range('A', 'Z');
		return $cell[$index];
	}

	// 根据参数判断格式
	private function getExt() {
		if ($this->sys['type'] == 'Excel5') {
			$this->extension = '.xls';
		} else {
			$this->extension = '.xlsx';
		}
	}

	// 浏览器输出保存
	private function browserExport() {
		ob_end_clean();
		if ($this->sys['type'] == 'Excel5') {
			header('Content-Type: application/vnd.ms-excel');
		} else {
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		}
		$filename = $this->sys['filename'].$this->extension;
		header('Content-Disposition: attachment;filename="'.$filename.'"');
		header('Cache-Control: max-age=0');
		header('Cache-Control: max-age=1');
		$writer = PHPExcel_IOFactory::createWriter($this->excel, $this->sys['type']);
		$writer->save('php://output');
	}
}