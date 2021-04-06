<?php namespace Grrr\SimplyStaticDeploy;

use Garp\Functional as f;

class Config
{
    private $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function __get(string $key)
    {
        $out = $this->data[$key] ?? null;
        if (is_array($out)) {
            return new self($out);
        }
        return $out;
    }
    
    public function getDestination()
    {
        $bucket = $this->data['bucket'];
        if ( is_multisite() )
        {
            return $bucket.get_blog_details()->path;
        }
        return $bucket;
    }
}
