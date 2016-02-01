<?php

namespace Kollarovic\Admin\Grido;

use Grido\Grid;
use Grido\Components\Columns\Text;
use Nette\Utils\Html;


class ColumnBoolean extends Text {

	const ITEMS = ['' => '', 1 => 'Ano', 0 => 'Ne'];


	public static function register(){
		
		Grid::extensionMethod('addColumnBoolean', function (Grid $grid, $name, $label) {
			return new ColumnBoolean($grid, $name, $label);
		});
	}


	public function getCellPrototype($row = NULL){
		
		$cell = parent::getCellPrototype($row = NULL);
		$cell->class[] = 'center';
		return $cell;
	}


	protected function formatValue($value){
		
		$icon = $value ? 'check text-success' : 'times text-danger';
		return Html::el('i')->class("fa fa-$icon");
	}

}