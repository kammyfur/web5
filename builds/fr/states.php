<?php $data = json_decode(file_get_contents("../data.json")); ?>
<a onclick="home();" id="home-link"><img src="home.svg" width="24px" height="24px" alt="" class="home-logo">Accueil</a>
<?php foreach ($data as $container): ?>
            <div class="container" id="container-<?= $container->name ?>">
                <img src="container.svg" width="24px" height="24px" alt="Container" class="container-logo"><?= $container->name ?>
                <div class="container-inner">
                    <?php foreach ($container->jobs as $job): ?>
                    <div class="job" id="job-<?= $job->name ?>">
                        <img src="job.svg" width="24px" height="24px" alt="Job" class="job-logo"><?= $job->name ?>
                        <div class="job-inner">
                            <div class="job-status">
                                <img src="job-<?php
                                
                                switch ($job->status) {
                                    case 'done':
                                        echo("success");
                                        break;

                                    case 'warn':
                                        echo("warn");
                                        break;

                                    case 'fail':
                                        echo("fail");
                                        break;

                                    case 'run':
                                        echo("running");
                                        break;
                                    
                                    default:
                                        echo("unknown");
                                        break;
                                }

                                ?>.svg" width="24px" height="24px" alt="" class="job-status-logo"><span class="job-status-msg <?php
                                
                                switch ($job->status) {
                                    case 'done':
                                        echo("success");
                                        break;

                                    case 'warn':
                                        echo("warn");
                                        break;

                                    case 'fail':
                                        echo("fail");
                                        break;

                                    case 'run':
                                        echo("running");
                                        break;
                                    
                                    default:
                                        echo("unknown");
                                        break;
                                }
                                
                                ?>"><?php
                                
                                switch ($job->status) {
                                    case 'done':
                                        echo("Succès");
                                        break;

                                    case 'warn':
                                        echo("Avertissements");
                                        break;

                                    case 'fail':
                                        echo("Échec");
                                        break;

                                    case 'run':
                                        echo("En cours");
                                        break;
                                    
                                    default:
                                        echo("État inconnu");
                                        break;
                                }
                                
                                ?></span>
                            </div>
                            <div class="job-time">
                                <img src="time.svg" width="24px" height="24px" alt="" class="job-time-logo"><span class="job-time-msg"><?php
                                
                                $now = new DateTime("now");
                                $update = DateTime::createFromFormat('Y-m-d-G-i-s', $job->update);
                                $diff = $update->diff($now);
                                if ($diff->i > 0) {
                                    if ($diff->i > 1) {
                                        $updated = "il y a " . $diff->i . " minutes";
                                    } else {
                                        $updated = "il y a " . $diff->i . " minute";
                                    }
                                } else {
                                    $updated = "à l'instant";
                                }
                                if ($diff->h > 0) {
                                    if ($diff->h > 1) {
                                        $updated = "il y a " . $diff->h . " heures";
                                    } else {
                                        $updated = "il y a " . $diff->h . " heure";
                                    }
                                }
                                if ($diff->d > 0) {
                                    if ($diff->d > 1) {
                                        $updated = "il y a " . $diff->d . " jours";
                                    } else {
                                        $updated = "il y a " . $diff->d . " jour";
                                    }
                                }
                                if ($diff->m > 0) {
                                    if ($diff->m > 1) {
                                        $updated = "il y a " . $diff->m . " mois";
                                    } else {
                                        $updated = "il y a " . $diff->m . " mois";
                                    }
                                }
                                if ($diff->y > 0) {
                                    if ($diff->y > 1) {
                                        $updated = " il y a " . $diff->y . " an";
                                    } else {
                                        $updated = " il y a " . $diff->y . " ans";
                                    }
                                }

                                echo($updated);

                                ?></span>
                            </div>
                            <?php if ((trim($job->log) != "") && ($job->status != "run")): ?>
                            <div class="job-logs">
                                <img src="job-logs.svg" width="24px" height="24px" alt="" class="job-logs-logo"><a onclick="logs('<?= $job->name ?>');" class="button job-logs-link">Fichier journal</a>
                            </div>
                            <?php elseif ((trim($job->log) == "") && ($job->status != "run")): ?>
                                <div class="job-logs">
                                <img src="job-logs.svg" width="24px" height="24px" alt="" class="job-logs-logo">Pas de journal
                            </div>
                            <?php endif ?>
                            <?php if ((count($job->artifacts) > 0) && ($job->status != "run")): ?>
                            <div class="job-artifacts">
                                <details>
                                    <summary><img src="job-artifacts.svg" width="24px" height="24px" alt="" class="job-artifacts-logo"><span class="button job-artifacts-link">Artéfacts</span></summary>
                                    <div class="job-artifacts-inner" id="artifacts-<?= $job->name ?>">
                                        <?php foreach ($job->artifacts as $artifact): ?>
                                        <div class="artifact">
                                            <img src="artifact.svg" width="24px" height="24px" alt="Artéfacts" class="artifact-logo"><a href="<?= $artifact->path ?>" class="button job-artifacts-link" download><?= $artifact->name ?></a>
                                        </div>
                                        <?php endforeach ?>
                                    </div>
                                </details>
                            </div>
                            <?php endif ?>
                        </div>
                    </div>
                    <?php endforeach ?>
                </div>
            </div>
            <?php endforeach ?>
            <center><?= count($data) ?> conteneur<?= count($data) > 1 ? "s" : "" ?>, <?php
            
            $count = 0;
            foreach ($data as $container) {
                foreach ($container->jobs as $job) {
                    $count++;
                }
            }

            echo($count);
            
            ?> tâche<?= $count > 1 ? "s" : "" ?><?php
            
            $failed = 0;
            foreach ($data as $container) {
                foreach ($container->jobs as $job) {
                    if ($job->status == "fail") {
                        $failed++;
                    }
                }
            }

            if ($failed > 0) {
                echo(", " . $failed . " tâche");
                if ($failed > 1) {
                    echo("s");
                }
                echo(" échouée");
                if ($failed > 1) {
                    echo("s");
                }
            }

            ?></center>