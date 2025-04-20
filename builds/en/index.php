<?php

if (isset($_GET['log'])) {
    header("Content-Type: text/plain");

    $data = json_decode(file_get_contents("../data.json"));

    foreach ($data as $container) {
        foreach ($container->jobs as $job) {
            if ($job->name == $_GET['log']) {
                $sel = $job;
            }
        }
    }

    if (!isset($sel)) {
        echo("Not found");
    } else {
        echo($sel->log);
    }

    die();
}

if (isset($_GET['states'])) {
    require_once "states.php";
    die();
}

if (isset($_GET['home'])) {
    echo(file_get_contents("home.html"));
    die();
}

if (isset($_GET['global'])) {
    require_once "gstat.php";
    die();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <script src="wrapper.js"></script>
    <title>Minteck Projects Continuous Integration</title>
    <script>location.href = "#";</script>
</head>
<body>
    <?php $data = json_decode(file_get_contents("../data.json")); ?>
    <header>
        <span id="title">Job Tracking</span>
        <span id="status">
            <div id="gstatus-loader">
                <img src="loader-dark.svg" alt="Please wait..." width="36px" height="36px" id="gstatus-loader-img">
            </div>
        </span>
    </header>

    <article>
        <div id="states">
            <div id="states-loader">
                <img src="loader.svg" alt="Please wait..." width="36px" height="36px" id="states-loader-img">
            </div>
        </div>
        <div id="log">
            <div id="log-inner">
                <div id="log-welcome">
                    <h1 class="log-title">
                        <img src="welcome.svg" width="32px" height="32px" alt="" class="log-welcome-logo"> Welcome!
                    </h1>
                    <div id="log-welcome-content"></div>
                    <div id="welcome-loader">
                        <img src="loader.svg" alt="Please wait..." width="36px" height="36px" id="welcome-loader-img">
                    </div>
                </div>
                <div id="log-logs" style="display:none;">
                    <h1 class="log-title">
                        <img src="logs.svg" width="32px" height="32px" alt="" class="log-logs-logo"> Log file for <span id="log-job">Unknown Job</span>
                    </h1>
                    <div id="log-loader">
                        <img src="loader.svg" alt="Please wait..." width="36px" height="36px" id="log-loader-img">
                    </div>
                    <div id="log-file" style="display:none;">Please wait...</div>
                </div>
            </div>
        </div>
    </article>
    
    <script>location.href = "#/script";</script>
    <script>
        function logs(file) {
            location.href = "#log";
            document.getElementById('log-welcome').style.display = "none";
            document.getElementById('log-logs').style.display = "block";
            document.getElementById('log-job').innerHTML = file;
            document.getElementById('log-file').style.display = "none";
            document.getElementById('log-loader').style.display = "flex";
            setTimeout(() => {
                $.ajax("?log=" + file, {
                    cache: false,
                    success: (data) => {
                        document.getElementById('log-file').innerHTML = data.split("<").join("&lt;").split(">").join("&gt;").split("\n").join("<br>");
                        document.getElementById('log-file').style.display = "block";
                        document.getElementById('log-loader').style.display = "none";
                    },
                    error: () => {
                        document.getElementById('log-file').innerHTML = "Error";
                        document.getElementById('log-file').style.display = "block";
                        document.getElementById('log-loader').style.display = "none";
                    },
                    method: 'GET',
                    statusCode: {
                        404: () => {
                            document.getElementById('log-file').innerHTML = "404";
                            document.getElementById('log-file').style.display = "block";
                            document.getElementById('log-loader').style.display = "none";
                        },
                        403: () => {
                            document.getElementById('log-file').innerHTML = "403";
                            document.getElementById('log-file').style.display = "block";
                            document.getElementById('log-loader').style.display = "none";
                        },
                        401: () => {
                            document.getElementById('log-file').innerHTML = "401";
                            document.getElementById('log-file').style.display = "block";
                            document.getElementById('log-loader').style.display = "none";
                        },
                        500: () => {
                            document.getElementById('log-file').innerHTML = "500";
                            document.getElementById('log-file').style.display = "block";
                            document.getElementById('log-loader').style.display = "none";
                        },
                        503: () => {
                            document.getElementById('log-file').innerHTML = "503";
                            document.getElementById('log-file').style.display = "block";
                            document.getElementById('log-loader').style.display = "none";
                        },
                    }
                })
            }, 1000)
        }

        window.onload = () => {
            location.href = "#/preload";
            setTimeout(() => {
                location.href = "#/fullfil/1";
                $.ajax("?states", {
                    cache: false,
                    success: (data) => {
                        document.getElementById('states').innerHTML = data;
                    },
                    error: () => {
                        document.getElementById('states').innerHTML = "Error";
                    },
                    complete: () => {
                        setTimeout(() => {
                            location.href = "#/fullfil/2";
                            $.ajax("?home", {
                                cache: false,
                                success: (data) => {
                                    document.getElementById('log-welcome-content').innerHTML = data;
                                    document.getElementById('welcome-loader').style.display = "none";
                                },
                                error: () => {
                                    document.getElementById('log-welcome-content').innerHTML = "Error";
                                    document.getElementById('welcome-loader').style.display = "none";
                                },
                                complete: () => {
                                    setTimeout(() => {
                                        location.href = "#/fullfil/3";
                                        $.ajax("?global", {
                                            cache: false,
                                            success: (data) => {
                                                document.getElementById('status').innerHTML = data;
                                            },
                                            error: () => {
                                                document.getElementById('status').innerHTML = "Error";
                                            },
                                            complete: () => {
                                                location.href = "#";
                                            },
                                            method: 'GET',
                                            statusCode: {
                                                404: () => {
                                                    document.getElementById('status').innerHTML = "404";
                                                },
                                                403: () => {
                                                    document.getElementById('status').innerHTML = "403";
                                                },
                                                401: () => {
                                                    document.getElementById('status').innerHTML = "401";
                                                },
                                                500: () => {
                                                    document.getElementById('status').innerHTML = "500";
                                                },
                                                503: () => {
                                                    document.getElementById('status').innerHTML = "503";
                                                },
                                            }
                                        })
                                    }, 1000)
                                },
                                method: 'GET',
                                statusCode: {
                                    404: () => {
                                        document.getElementById('log-welcome-content').innerHTML = "404";
                                        document.getElementById('welcome-loader').style.display = "none";
                                    },
                                    403: () => {
                                        document.getElementById('log-welcome-content').innerHTML = "403";
                                        document.getElementById('welcome-loader').style.display = "none";
                                    },
                                    401: () => {
                                        document.getElementById('log-welcome-content').innerHTML = "401";
                                        document.getElementById('welcome-loader').style.display = "none";
                                    },
                                    500: () => {
                                        document.getElementById('log-welcome-content').innerHTML = "500";
                                        document.getElementById('welcome-loader').style.display = "none";
                                    },
                                    503: () => {
                                        document.getElementById('log-welcome-content').innerHTML = "503";
                                        document.getElementById('welcome-loader').style.display = "none";
                                    },
                                }
                            })
                        }, 1000)
                    },
                    method: 'GET',
                    statusCode: {
                        404: () => {
                            document.getElementById('states').innerHTML = "404";
                        },
                        403: () => {
                            document.getElementById('states').innerHTML = "403";
                        },
                        401: () => {
                            document.getElementById('states').innerHTML = "401";
                        },
                        500: () => {
                            document.getElementById('states').innerHTML = "500";
                        },
                        503: () => {
                            document.getElementById('states').innerHTML = "503";
                        },
                    }
                })
            }, 1000)
        }

        function home() {
            location.href = "#log";
            document.getElementById('welcome-loader').style.display = "flex";
            document.getElementById('log-welcome-content').innerHTML = "";
            document.getElementById('log-welcome').style.display = "block";
            document.getElementById('log-logs').style.display = "none";
            document.getElementById('log-file').style.display = "none";
            document.getElementById('log-loader').style.display = "none";
            setTimeout(() => {
                $.ajax("?home", {
                    cache: false,
                    success: (data) => {
                        document.getElementById('log-welcome-content').innerHTML = data;
                        document.getElementById('welcome-loader').style.display = "none";
                    },
                    error: () => {
                        document.getElementById('log-welcome-content').innerHTML = "Error";
                        document.getElementById('welcome-loader').style.display = "none";
                    },
                    method: 'GET',
                    statusCode: {
                        404: () => {
                            document.getElementById('log-welcome-content').innerHTML = "404";
                            document.getElementById('welcome-loader').style.display = "none";
                        },
                        403: () => {
                            document.getElementById('log-welcome-content').innerHTML = "403";
                            document.getElementById('welcome-loader').style.display = "none";
                        },
                        401: () => {
                            document.getElementById('log-welcome-content').innerHTML = "401";
                            document.getElementById('welcome-loader').style.display = "none";
                        },
                        500: () => {
                            document.getElementById('log-welcome-content').innerHTML = "500";
                            document.getElementById('welcome-loader').style.display = "none";
                        },
                        503: () => {
                            document.getElementById('log-welcome-content').innerHTML = "503";
                            document.getElementById('welcome-loader').style.display = "none";
                        },
                    }
                })
            }, 1000)
        }

        setInterval(() => {
            document.getElementById('status').innerHTML = `<div id="gstatus-loader"><img src="loader-dark.svg" alt="Please wait..." width="36px" height="36px" id="gstatus-loader-img"></div>`;
            setTimeout(() => {
                $.ajax("?states", {
                    cache: false,
                    success: (data) => {
                        document.getElementById('states').innerHTML = data;
                    },
                    error: () => {
                        document.getElementById('states').innerHTML = "Error";
                    },
                    complete: () => {
                        setTimeout(() => {
                            $.ajax("?global", {
                                cache: false,
                                success: (data) => {
                                    document.getElementById('status').innerHTML = data;
                                },
                                error: () => {
                                    document.getElementById('status').innerHTML = "Error";
                                },
                                method: 'GET',
                                statusCode: {
                                    404: () => {
                                        document.getElementById('status').innerHTML = "404";
                                    },
                                    403: () => {
                                        document.getElementById('status').innerHTML = "403";
                                    },
                                    401: () => {
                                        document.getElementById('status').innerHTML = "401";
                                    },
                                    500: () => {
                                        document.getElementById('status').innerHTML = "500";
                                    },
                                    503: () => {
                                        document.getElementById('status').innerHTML = "503";
                                    },
                                }
                            })
                        }, 1000)
                    },
                    method: 'GET',
                    statusCode: {
                        404: () => {
                            document.getElementById('states').innerHTML = "404";
                        },
                        403: () => {
                            document.getElementById('states').innerHTML = "403";
                        },
                        401: () => {
                            document.getElementById('states').innerHTML = "401";
                        },
                        500: () => {
                            document.getElementById('states').innerHTML = "500";
                        },
                        503: () => {
                            document.getElementById('states').innerHTML = "503";
                        },
                    }
                })
            }, 1000)
        }, 30000)
    </script>
</body>
</html>
