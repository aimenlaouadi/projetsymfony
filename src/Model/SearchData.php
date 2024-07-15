<?php

namespace App\Model;


class SearchData
{
    
    private int $page = 1;

    private string $query = '';

    /**
     * Get the value of page
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * Set the value of page
     */
    public function setPage($page): self
    {
        $this->page = $page;

        return $this;
    }

    /**
     * Get the value of q
     *
     * @return string
     */
    public function getQuery(): string
    {
        return $this->query;
    }

    /**
     * Set the value of q
     *
     * @param string $query
     *
     * @return self
     */
    public function setQuery(string $query): self
    {
        $this->query = $query;

        return $this;
    }
}