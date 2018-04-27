<?php 
class Model_Chart { 

/*
*	Class handling the creation of an SVG chart from a associatve array dataset
*	
*
*/
	private $dataset; //could be an array
	private $height;
	private $width;
	private $legend;
	private $grid;
	
	function __construct()
	{ 
		$this->height=500;
		$this->width=1000;
		$this->dataset=["2018-01-12" => 1,"2018-01-14"=> 2,"2018-01-18"=> 3,"2018-01-22"=> 4,"2018-01-30" => 5];
	}
	
	public function axisSpanCalculation()
	{
		ksort($this->dataset);
		reset($this->dataset);
		$start=DateTime::createFromFormat('Y-m-d',key($this->dataset));
		end($this->dataset);
		$end=DateTime::createFromFormat('Y-m-d',key($this->dataset));
		$interval = $start->diff($end);
		$xRatio=$this->width/$interval->days;
		print_r(floor($xRatio));
	}
	
	public function render()
	{
		#foreach
		return '<svg version="1.2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="'.$this->width.'" height="'.$this->height.'" aria-labelledby="title" role="img">
				  <title id="title">A line chart showing some information</title>
				<g class="grid y-grid" id="yGrid">
				  <line x1="90" x2="90" y1="5" y2="371"></line>
				</g>
				<g class="grid x-grid" id="xGrid">
				  <line x1="50" x2="'.$this->width.'" y1="'.($this->height-50).'" y2="'.($this->height-50).'"></line>
				</g> 
				  <g class="labels x-labels">
				  <text x="100" y="400">2008</text>
				  <text x="246" y="400">2009</text>
				  <text x="392" y="400">2010</text>
				  <text x="538" y="400">2011</text>
				  <text x="684" y="400">2012</text>
				  <text x="400" y="440" class="label-title">Year</text>
				</g>
				<g class="labels y-labels">
				  <text x="80" y="15">15</text>
				  <text x="80" y="131">10</text>
				  <text x="80" y="248">5</text>
				  <text x="80" y="373">0</text>
				  <text x="50" y="200" class="label-title">Price</text>
				</g>
				</svg>';
	}
} 

?> 