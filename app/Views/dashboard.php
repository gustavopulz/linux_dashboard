<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard do Sistema</title>
    <link rel="icon" href="<?= base_url('imagens/icon.png') ?>" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .content {
            margin-left: 270px; 
            padding: 20px; 
        }

        .status-box {
            height: 200px; 
            background-color: #333; 
            color: #fff; 
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            padding: 10px; 
        }

        .status-box2 {
            height: 200px; 
            background-color: #333; 
            color: #fff; 
            border-radius: 8px;
            padding: 10px; 
            display: flex; 
            flex-direction: column; 
            justify-content: center;
            align-items: center;
        }

        .status-title {
            font-size: 1.2em;
            margin-bottom: 5px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <?php include 'sidebar.php'; ?> 

        <div class="content container mt-5" style="margin-left: 130px">
            <h1 class="text-center">Dashboard do Sistema</h1>

            <div class="row mt-5" style="margin-left: 10px">
                <div class="col-12 col-md-4 mb-3">
                    <h4 class="status-title text-center">CPU</h4>
                    <div class="status-box" id="cpu-status">
                        <div>Carregando...</div>
                    </div>
                </div>
                <div class="col-12 col-md-4 mb-3"> 
                    <h4 class="status-title text-center">Memória</h4>
                    <div class="status-box" id="memory-status" style="display: flex; flex-direction: column; align-items: center;">
                        <div><span id="memory-usage">Carregando...</span></div>
                        <div><span id="memory-info">1415/7879MB</span></div> 
                    </div>
                </div>
                <div class="col-12 col-md-4 mb-3"> 
                    <h4 class="status-title text-center">Disco</h4>
                    <div class="status-box" id="disk-status" style="display: flex; flex-direction: column; align-items: center;">
                        <div><span id="disk-usage">Carregando...</span></div>
                        <div><span id="disk-info">100GB/500GB</span></div>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-12 mb-3"> 
                    <h4 class="status-title text-center">Informações S.O.</h4>
                    <div class="status-box2" id="os-info" style="margin-left: 20px">
                        <div id="os-distribution">Distribuição: Carregando...</div>
                        <div id="os-architecture">Arquitetura: Carregando...</div>
                        <div id="os-version">Versão: Carregando...</div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script>
        function fetchSystemStatus() {
            $.ajax({
                url: '/dashboard/getSystemStatus', 
                method: 'GET',
                success: function(data) {
                    $('#cpu-status div').text(data.cpu);
                    $('#memory-status #memory-usage').text(data.memoryUsage); 
                    $('#memory-status #memory-info').text(data.memoryInfo + 'MB'); 
                    $('#disk-status #disk-usage').text(data.disk); 
                    $('#disk-status #disk-info').text(data.diskInfo); 
                    $('#os-distribution').text('Distribuição: ' + data.osDistribution);
                    $('#os-version').text('Versão: ' + data.osVersion);
                    $('#os-architecture').text('Arquitetura: ' + data.osArchitecture);
                },

                error: function() {
                    $('#cpu-status div').text('Erro ao obter status da CPU.');
                    $('#memory-status div').text('Erro ao obter status da memória.');
                    $('#disk-status div').text('Erro ao obter status do disco.');
                    $('#os-distribution').text('Erro ao obter distribuição do SO.');
                    $('#os-version').text('Erro ao obter versão do SO.');
                    $('#os-architecture').text('Erro ao obter arquitetura do SO.');
                }
            });
        }

        $(document).ready(function() {
            fetchSystemStatus();
            setInterval(fetchSystemStatus, 5000); 
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
