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
                echo("Tout terminé");
            } else {
                if ($running > 1) {
                    echo($running . " tâches en cours");
                } else {
                    echo($running . " tâche en cours");
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
                echo("<b>, " . $failed . " échec");
                if ($failed > 1) {
                    echo("s</b>");
                } else {
                    echo("</b>");
                }
            }
            
            ?>