<?php

/**
 * @file
 * Contains EC\EuropaSearch\Messages\Search\SearchRequest.
 */

namespace EC\EuropaSearch\Messages\Search;

use EC\EuropaSearch\Messages\AbstractRequest;

/**
 * Class SearchRequest.
 *
 * It defines a search request that is sent for indexing to the Europa Search
 * services.
 *
 * @package EC\EuropaSearch\Messages\Search
 */
class SearchRequest extends AbstractRequest
{

    /**
     * The search query in a JSOn format.
     *
     * @var string
     */
    private $queryJSON;

    /**
     * The searched text.
     *
     * @var string
     */
    private $text;

    /**
     * Languages implied in teh search.
     *
     * @var array
     */
    private $languages;

    /**
     * The page number of the result list to retrieve.
     *
     * @var integer
     */
    private $pageNumber;

    /**
     * The number of results to retrieve.
     *
     * @var integer
     */
    private $pageSize;

    /**
     * The regular expression to use to highlight result texts.
     *
     * @var string
     */
    private $highlightRegex;

    /**
     * The length of the highlighted text.
     *
     * @var integer
     */
    private $highlightLimit;

    /**
     * The session token.
     *
     * @var string
     */
    private $sessionToken;

    /**
     * The sort criteria to apply with the search request.
     *
     * @var string
     */
    private $sort;

    /**
     * Gets the search query in a JSON format.
     *
     * @return string
     *   The JSON query.
     */
    public function getQueryJSON()
    {
        return $this->queryJSON;
    }

    /**
     * Sets the search query in a JSON format.
     *
     * @param string $queryJSON
     *   The JSON query.
     */
    public function setQueryJSON($queryJSON)
    {
        $this->queryJSON = $queryJSON;
    }

    /**
     * Gets the searched text.
     *
     * @return string
     *   The searched text.
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Sets the searched text.
     *
     * @param string $text
     *   The searched text.
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * Gets the list of languages implied in the search.
     *
     * @return array
     *   The list of implied languages
     */
    public function getLanguages()
    {
        return $this->languages;
    }

    /**
     * Sets the list of languages implied in the search.
     *
     * @param array $languages
     *   The list of implied languages
     */
    public function setLanguages(array $languages)
    {
        $this->languages = $languages;
    }

    /**
     * Gets the page number.
     *
     * @return int
     *   The page number.
     */
    public function getPageNumber()
    {
        return $this->pageNumber;
    }

    /**
     * Sets the page number.
     *
     * @param int $pageNumber
     *   The page number.
     */
    public function setPageNumber($pageNumber)
    {
        $this->pageNumber = $pageNumber;
    }

    /**
     * Gets the number of results to retrieve.
     *
     * @return int
     *   The number of results to retrieve.
     */
    public function getPageSize()
    {
        return $this->pageSize;
    }

    /**
     * Sets the number of results to retrieve.
     *
     * @param int $pageSize
     *   The number of results to retrieve.
     */
    public function setPageSize($pageSize)
    {
        $this->pageSize = $pageSize;
    }

    /**
     * Gets the regular expression to use to highlight result texts.
     *
     * @return string
     *   The regular expression to use.
     */
    public function getHighlightRegex()
    {
        return $this->highlightRegex;
    }

    /**
     * Sets the regular expression to use to highlight result texts.
     *
     * @param string $highlightRegex
     *   The regular expression to use.
     */
    public function setHighlightRegex($highlightRegex)
    {
        $this->highlightRegex = $highlightRegex;
    }

    /**
     * Gets the length of the highlighted text.
     *
     * @return int
     *   The length of the highlighted text.
     */
    public function getHighlightLimit()
    {
        return $this->highlightLimit;
    }

    /**
     * Sets the length of the highlighted text.
     *
     * @param int $highlightLimit
     *   The length of the highlighted text.
     */
    public function setHighlightLimit($highlightLimit)
    {
        $this->highlightLimit = $highlightLimit;
    }

    /**
     * Gets the session token to use with search (if restricted).
     *
     * @return string
     *  The session token to use.
     */
    public function getSessionToken()
    {
        return $this->sessionToken;
    }

    /**
     * Sets the session token to use with search (if restricted).
     *
     * @param string $sessionToken
     *  The session token to use.
     */
    public function setSessionToken($sessionToken)
    {
        $this->sessionToken = $sessionToken;
    }

    /**
     * Gets the sort criteria to apply with the search request.
     *
     * @return string
     *   The sort criteria to apply.
     *
     */
    public function getSort()
    {
        return $this->sort;
    }

    /**
     * Sets the sort criteria to apply with the search request.
     *
     * @param string $sort
     *   The sort criteria to apply.
     */
    public function setSort($sort)
    {
        $this->sort = $sort;
    }

    /**
     * {@inheritDoc}
     */
    public function addConvertedComponents(array $components)
    {

        $json = json_encode($components);
        $this->setQueryJSON($json);
    }
}
