<?php $data = json_decode(file_get_contents("../data.json")); ?>
<?php
            
            $running = 0;
            foreach ($data as $container) {
                foreach ($container->jobs as $job) {
                    if ($job->status == "run") {
                        $running++;
                    }
                }
            }

            if ($running == 0) {
                echo("All jobs finished");
            } else {
                if ($running > 1) {
                    echo($running . " jobs running");
                } else {
                    echo($running . " job running");
                }
            }

            $failed = 0;
            foreach ($data as $container) {
                foreach ($container->jobs as $job) {
                    if ($job->status == "fail") {
                        $failed++;
                    }
                }
            }

            if ($failed > 0) {
                echo("<b>, " . $failed . " fail");
                if ($failed > 1) {
                    echo("s</b>");
                } else {
                    echo("</b>");
                }
            }
            
            ?>