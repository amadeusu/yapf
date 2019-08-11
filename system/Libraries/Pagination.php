<?php

namespace System\Libraries;

class Pagination {
    /**
     * @var int
     */
    private $currentPage;

    /**
     * @var int
     */
    private $recorndCount;

    /**
     * @var int
     */
    private $perPageLimit;

    /**
     * @var int
     */
    private $maxPagesCount;

    /**
     * @var int
     */
    private $pagesCount;

    /**
     * @param int $page
     * @return $this
     */
    public function setCurrentPage($page = 1) {
        $this->currentPage = $page;
        return $this;
    }

    /**
     * @param int $perPageLimit
     * @return $this
     */
    public function setPerPageLimit(int $perPageLimit)
    {
        $this->perPageLimit = $perPageLimit;
        return $this;
    }

    /**
     * @param int $recorndCount
     * @return $this
     */
    public function setRecorndCount(int $recorndCount)
    {
        $this->recorndCount = $recorndCount;
        return $this;
    }

    /**
     * @param int $maxPagesCount
     * @return $this
     */
    public function setMaxPagesCount(int $maxPagesCount)
    {
        $this->maxPagesCount = $maxPagesCount;
        return $this;
    }

    /**
     * @return array
     */
    public function getPageRange() {
        $this->pagesCount = cell($this->recorndCount / $this->perPageLimit);
        $firstPageInRange = $this->currentPage - (int)($this->maxPagesCount / 2);
        $firstPageInRange = $this->pagesCount - $firstPageInRange < $this->maxPagesCount
                                    ? $this->pagesCount - $this->maxPagesCount + 1
                                    : $firstPageInRange;

        $firstPageInRange = $firstPageInRange < 1 ? 1 : $firstPageInRange;
        $lastPageInRange = $firstPageInRange + ($this->maxPagesCount - 1);
        $lastPageInRange = $lastPageInRange > $this->pagesCount
                                    ? $this->pagesCount
                                    : $lastPageInRange;
        $lastPageInRange = $lastPageInRange <= 0 ? 1 : $lastPageInRange;

        return range($firstPageInRange, $lastPageInRange);
    }

    /**
     * @return array
     */
    public function getPages(){
        $pages = [
            'current'   => $this->currentPage,
            'pages'     => $this->getPageRange(),
        ];

        $prevPage = $this->currentPage != 1 ? $this->currentPage - 1 : null;
        $nextPage = $this->currentPage < $this->pagesCount ? $this->currentPage + 1 : null;
        $lastPage = $nextPage ? $this->pagesCount : null;

        !$prevPage ?: $pages['prev'] = $prevPage;
        !$nextPage ?: $pages['next'] = $nextPage;
        !$lastPage ?: $pages['last'] = $lastPage;

        return $pages;
    }
}