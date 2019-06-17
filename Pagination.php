<?php

namespace App;

use App;

class Pagination {

    private $totalItems;
    private $itemsOnPage;
    private $currentPage;
    private $sortBy;

    public function __construct($totalItems, $itemsOnPage, $currentPage, $sortBy, $sortDirection) {
		$this->totalItems = (int) $totalItems;
		$this->itemsOnPage = (int) $itemsOnPage;
		$this->currentPage = (int) $currentPage;
		$this->sortBy = '&sort='.$sortBy;
		$this->sortDirection = '&sortDirection='.$sortDirection;
    }

    public function showPrev() {
        if ($this->currentPage > 1) return true;
        return false;
    }

    public function showNext() {
        if ($this->currentPage != ceil($this->totalItems/$this->itemsOnPage)) return true;
        return false;
    }

    public function getBlock($action = 'home')
	{
		$html = "";

		if ($this->showPrev()) {
            $html .= '<li class="page-item">';
            $html .= '<a class="page-link" href="?'.'page='.($this->currentPage-1).$this->sortBy.$this->sortDirection.'" tabindex="-1" aria-disabled="true">';
			$html .= 'Previous';
			$html .= '</a>';
			$html .= '</li>';
        }

        for($i=1; $i<=ceil($this->totalItems/$this->itemsOnPage); $i++) {
			if ($i != $this->currentPage) {
				$html .= '<li class="page-item"><a class="page-link" href="?'.'page='.$i.$this->sortBy.$this->sortDirection.'">'.$i.'</a></li>';
			} else {
				$html .= '<li class="page-item active"><a class="page-link" href="?'.'page='.$i.$this->sortBy.$this->sortDirection.'">'.$i.'</a></li>';
			}
		}

        if ($this->showNext()) {
            $html .= '<li class="page-item">';
            $html .= '<a class="page-link" href="?'.'page='.($this->currentPage+1).$this->sortBy.$this->sortDirection.'" tabindex="-1" aria-disabled="true">';
			$html .= 'Next';
            $html .= '</a>';
			$html .= '</li>';
		}

        $html = '<nav aria-label="pagination"><ul class="pagination">'.$html.'</ul></nav>';
		return $html;
	}

}