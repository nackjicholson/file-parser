<?php

namespace Nack\FileParser\FileSystem;

class GetFileContentsHarness
{
    use GetFileContentsTrait;

    public function executeGetFileContents($argumentList)
    {
        return call_user_func_array([ $this, 'getFileContents' ], $argumentList);
    }
}
