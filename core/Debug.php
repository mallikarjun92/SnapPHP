<?php

namespace Core;

class Debug
{
    private $queries = [];
    private $startTime;

    public function __construct()
    {
        // Start timing when the Debug class is instantiated
        $this->startTime = microtime(true);
    }

    public function logQuery($query)
    {
        $this->queries[] = $query;
    }

    public function getExecutionTime()
    {
        return microtime(true) - $this->startTime;
    }

    public function getMemoryUsage()
    {
        return memory_get_usage();
    }

    public function getPeakMemoryUsage()
    {
        return memory_get_peak_usage();
    }

    private function formatMemory($memory)
    {
        // Convert memory size to a human-readable format
        if ($memory < 1024) {
            return $memory . ' bytes';
        } elseif ($memory < 1048576) {
            return round($memory / 1024, 2) . ' KB';
        } else {
            return round($memory / 1048576, 2) . ' MB';
        }
    }

    public function render()
    {
        
        // Only render if debugging is enabled in the .env file
        if ($_ENV['DEBUG_MODE'] !== 'true') {
            return;
        }

        echo '<br />';
        echo '<details open >';
        echo '<summary>Debug Info</summary>';
        echo '<div class="debug-info" style="background-color: #f9f9f9; border: 1px solid #ccc; padding: 10px; margin-top: 10px;">';
        echo '<h4>Debug Information</h4>';
                
        echo '<strong>Executed Queries:</strong><br>';
        echo '<ul>';
        foreach ($this->queries as $query) {
            // echo '<li>' . htmlspecialchars($query) . '</li>';
            echo '<li>' . $query . '</li>';
        }
        echo '</ul>';
       
        echo '<strong>Execution Time:</strong> ' . number_format($this->getExecutionTime(), 4) . ' seconds<br>';
        echo '<strong>Memory Usage:</strong> ' . $this->formatMemory($this->getMemoryUsage()) . '<br>';
        echo '<strong>Peak Memory Usage:</strong> ' . $this->formatMemory($this->getPeakMemoryUsage()) . '<br>';
        echo '<strong>Included Files:</strong><br>';
        echo '<ul>';

        foreach (get_included_files() as $file) {
            echo '<li>' . $file . '</li>';
        }

        echo '</ul>';

        echo '</ul>';
        echo '</div>';
        echo '</details>';
    }
}
