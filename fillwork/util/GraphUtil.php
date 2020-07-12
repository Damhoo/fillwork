<?php
namespace fillwork\util;

use fillwork\core\Tool;
use Amenadiel\JpGraph\Graph;
use Amenadiel\JpGraph\Plot;

class GraphUtil {
	private $canva = [
		'width' => '350',
		'height' => '250',
		'title' => '示例',
		'show_box' => true,
		'slice' => ['#1E90FF','#2E8B57','#ADFF2F','#DC143C','#BA55D3'],
		'legends' => ["One", "Two", "Three", "Four", "Five"],
		'pltheme' => ''
	];
	private $line = [
		'width' => '350',
		'height' => '250',
		'title' => 'Demo LinePlot',
		'scale' => 'textlin',
		'margin' => [40,20,36,63],
		'xline' => 'solid',
		'labels' => [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20],
		'xcolor' => '#E3E3E3'
	];
	private $bar = [
		'width' => '350',
		'height' => '250',
		'cacheName' => 'auto',
		'scale' => 'textlin',
		'title' => 'Demo BarPlot',
		'show_box' => false,
		'bgColor' => 'white',
		'gradient' => [
			'side' => '#4B0082',// sidecolor
			'mide' => 'white',// middlecolor
			'width' => '45'
		],
		'ycolor' => '#efefef',
		'angle' => 45,
		'position' => 0.5
	];
	private $graph = null; // 图形对象
	private $pieGraph = null; // 丙状图形
	private $lineplot = null; // 线形对象
	private $barPlot = null; // 柱形对象
	private $groupBarPlot = null; // 柱形组对象
	private $txt = null; // 文本对象
	private $pieplot = null; // 丙状图对象

	// 禁止外部实例化
	final public function __construct($cus){
		switch ($cus['type']) {
			case 'line':
				$this->line = array_merge($this->line, $cus);break;
			case 'bar':
				$this->bar = array_merge($this->bar, $cus);break;
			default:
				$this->canva = array_merge($this->canva, $cus);break;
		}
	}

	/**
	 * $data 二维数组
	 */
	public function generateLine($data, $label, $theme='UniversalTheme') {
		// Setup the graph
		$this->graph = Canva::getGraph($this->line);
		$this->graph->SetScale($this->line['scale']);

		if (!empty($theme)) {
			$class = "Amenadiel\JpGraph\Themes\\{$theme}";
			$theme_class = new $class;
			$this->graph->SetTheme($theme_class);
		}
		
		$this->graph->img->SetAntiAliasing(false);
		$this->graph->title->Set($this->line['title']);
		$this->graph->SetBox(false);

		if (version_compare(PHP_VERSION, '7.0.0', 'ge')) {
			list($left, $bottom, $right, $top) = $this->line['margin'];
		} else {
			list($top, $right, $bottom, $left) = $this->line['margin'];
		}
		$this->graph->SetMargin($top, $right, $bottom, $left);
		$this->graph->img->SetAntiAliasing();

		$this->graph->yaxis->HideZeroLabel();
		$this->graph->yaxis->HideLine(false);
		$this->graph->yaxis->HideTicks(false,false);

		$this->graph->xgrid->Show();
		$this->graph->xgrid->SetLineStyle($this->line['xline']);
		$this->graph->xaxis->SetTickLabels($label);
		$this->graph->xgrid->SetColor($this->line['xcolor']);

		$total = count($data);
		if ($total > 1) {
			for ($i=0; $i < $total; $i++) { 
				$this->lineplot = new Plot\LinePlot($data[$i]['data']);
				$this->graph->Add($this->lineplot);
				$this->lineplot->SetColor($data[$i]['color']);
				$this->lineplot->SetLegend($data[$i]['legend']);
			}
		} else {
			$this->lineplot = new Plot\LinePlot($data['data']);
			$this->graph->Add($this->lineplot);
			$this->lineplot->SetColor($data['color']);
			$this->lineplot->SetLegend($data['legend']);
		}
		$this->graph->legend->SetFrameWeight(2);

		// Output line
		$this->graph->Stroke();
	}

	// 画饼状图
	public function generatePie($data, $bgColor, $pie3d=false, $theme='') {
		// Canva
		$this->pieGraph = Canva::getGraph($this->canva, 'PieGraph');
		$this->pieGraph->SetShadow();
		$this->pieGraph->title->SetFont(FF_CHINESE, FS_NORMAL, 15);
		$this->pieGraph->title->Set($this->canva['title']);
		$this->pieGraph->SetBox($this->canva['show_box']);
		// 设置legends字体，以便可以显示中文
		$this->pieGraph->legend->SetFont(FF_CHINESE, FS_NORMAL, 9);

		// 3D设置背景
		if ($pie3d && !empty($theme)) {
			$theme = "Amenadiel\JpGraph\Themes\\$theme";
			$theme_class= new $theme;
			$this->pieGraph->SetTheme($theme_class);
		}

		// Create
		if ($pie3d) {
			$this->pieplot = new Plot\PiePlot3D($data);
			// 数值越大，倾斜度越大
			$this->pieplot->SetAngle($this->bar['angle']);
		} else {
			$this->pieplot = new Plot\PiePlot($data);
		}
		// 有主题则设置
		!empty($this->canva['pltheme']) && $this->pieplot->SetTheme($this->canva['pltheme']);
		// 0.5为居中显示
		$this->pieplot->SetCenter($this->bar['position']);
		// 设置图形比例显示字体(一般不用设置)
		// $this->pieplot->value->SetFont(FF_CHINESE, FS_NORMAL, 12);
		$this->pieplot->SetLegends($this->canva['legends']);
		$this->pieGraph->Add($this->pieplot);
		
		$this->pieplot->ShowBorder();
		$this->pieplot->SetColor($bgColor);
		$this->pieplot->ExplodeSlice(1);
		$this->pieplot->SetSliceColors($this->canva['slice']);
		$this->pieGraph->Stroke();
	}

	// 画柱状图
	public function generateBar($ydata, $bgColor, $ytick, $xtick) {
		// Create the graph.
		$graph = Canva::getGraph($this->bar, 'Graph', 'auto');
		$graph->SetScale($this->bar['scale']);
		$graph->title->Set($this->bar['title']);

		$graph->yaxis->SetTickPositions($ytick['y1']);
		$graph->SetBox($this->bar['show_box']);

		$graph->ygrid->SetColor($this->bar['ycolor']);
		$graph->ygrid->SetFill(false);
		$graph->xaxis->SetTickLabels($xtick);
		$graph->yaxis->HideLine(false);
		$graph->yaxis->HideTicks(false,false);

		// Create the bar plots
		$this->barPlot = new Plot\BarPlot($ydata);
		$graph->Add($this->barPlot);


		$this->barPlot->SetColor($bgColor);
		// 呈现渐变柱状图
		$this->barPlot->SetFillGradient($this->bar['gradient']['side'],$this->bar['gradient']['mide'],GRAD_LEFT_REFLECTION);
		$this->barPlot->SetWidth($this->bar['gradient']['width']);
		
		// Display the graph
		$graph->Stroke();
	}
}