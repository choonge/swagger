<?php

namespace gossi\swagger;

use gossi\swagger\parts\ConsumesPart;
use gossi\swagger\parts\ExtensionPart;
use gossi\swagger\parts\ExternalDocsPart;
use gossi\swagger\parts\ParametersPart;
use gossi\swagger\parts\ProducesPart;
use gossi\swagger\parts\ResponsesPart;
use gossi\swagger\parts\SchemesPart;
use gossi\swagger\parts\TagsPart;
use phootwork\collection\CollectionUtils;
use phootwork\lang\Arrayable;

class Operation extends AbstractModel implements Arrayable
{
    use ConsumesPart;
    use ProducesPart;
    use TagsPart;
    use ParametersPart;
    use ResponsesPart;
    use SchemesPart;
    use ExternalDocsPart;
    use ExtensionPart;

    /** @var string */
    private $summary;

    /** @var string */
    private $description;

    /** @var string */
    private $operationId;

    /** @var bool */
    private $deprecated = false;

    public function __construct(array $data = [])
    {
        $this->parse($data);
    }

    private function parse(array $data)
    {
        $this->mergeConsumes($data);
        $this->mergeParameters($data);

        $data = CollectionUtils::toMap($data);

        $this->summary = $data->get('summary');
        $this->description = $data->get('description');
        $this->operationId = $data->get('operationId');
        $this->deprecated = $data->has('deprecated') && $data->get('deprecated');

        // parts
        $this->parseProduces($data);
        $this->parseTags($data);
        $this->parseResponses($data);
        $this->parseSchemes($data);
        $this->parseExternalDocs($data);
        $this->parseExtensions($data);
    }

    public function toArray()
    {
        return $this->export('summary', 'description', 'operationId', 'deprecated',
                'consumes', 'produces', 'parameters', 'responses', 'schemes', 'tags',
                'externalDocs');
    }

    /**
     * @return the string
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * @param string $summary
     *
     * @return $this
     */
    public function setSummary($summary)
    {
        $this->summary = $summary;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string
     */
    public function getOperationId()
    {
        return $this->operationId;
    }

    /**
     * @param string $operationId
     *
     * @return $this
     */
    public function setOperationId($operationId)
    {
        $this->operationId = $operationId;

        return $this;
    }

    /**
     * @return bool
     */
    public function getDeprecated()
    {
        return $this->deprecated;
    }

    /**
     * @param bool $deprecated
     *
     * @return $this
     */
    public function setDeprecated($deprecated)
    {
        $this->deprecated = $deprecated;

        return $this;
    }
}
