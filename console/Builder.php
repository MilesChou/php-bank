<?php
namespace Console;

use MilesChou\Bank\StaticFile;
use ReflectionClass;

class Builder
{
    /**
     * @var string
     */
    private $template = <<< 'EOF'
<?php
namespace MilesChou\Bank;

/**
 * NOTE: THIS SOURCE CODE IS GENERATED VIA "Console\Command\Build" COMMAND
 *
 * PLEASE DO NOT EDIT IT DIRECTLY.
 */
class StaticFile extends Resource
{
    /**
     * @return array
     */
    public function fetchData()
    {
        return [
%s
        ];
    }
}

EOF;

    /**
     * @var string
     */
    private $templateCode = '            %s,';

    /**
     * Build data files
     * @param array $data
     */
    public function build(array $data)
    {
        $templateCode = '';

        foreach ($data as $name => $detail) {
            unset($detail[3], $detail[4], $detail[5], $detail[6], $detail[7]);

            $code = sprintf(
                $this->templateCode,
                var_export($detail, true)
            );

            $templateCode .= $code . PHP_EOL;
        }

        $newContent = sprintf($this->template, $templateCode);

        $reflection = new ReflectionClass(StaticFile::class);
        $path = $reflection->getFileName();

        file_put_contents($path, $newContent);
    }
}
