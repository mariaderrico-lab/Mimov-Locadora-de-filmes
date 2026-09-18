<?php
session_start();
if (!isset($_SESSION["usuario_logado"])) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mimov - Catálogo</title>
    <link rel="stylesheet" href="Css/Catalogo.css">
</head>
<body>
<header>
    <div class="logo">MIMOV</div>
    <nav>
        <a href="painel.php">Início</a>
        <a href="catalogo.php" class="ativo">Catálogo</a>
        <a href="logout.php">Sair</a>
    </nav>
</header>
<main>
    <div class="titulo">
        <h1>Catálogo de Filmes</h1>
        <p>Confira os filmes disponíveis para locação</p>
        <a href="add.php" class="botao-adicionar">
            + Adicionar Filme
        </a>
    </div>
    <section class="catalogo">
        <div class="filme">
            <img src="templates/img/mulherzinhas.jpg" alt="Mulherzinhas">
            <div class="informacoes">
                <h2>Mulherzinhas</h2>
                <p><strong>Ano:</strong> 2019</p>
                <p><strong>Gênero:</strong> Drama</p>
                <span class="disponivel">Disponível</span>
                <p class="preco">R$ 10,00</p>
                <a href="Alugar.php?id=1" class="alugar">
                    Alugar
                </a>
            </div>
        </div>
        <div class="filme">
            <img src="templates/img/diariodeumapaixao.jpg" alt="O Diário de uma Paixão">
            <div class="informacoes">
                <h2>O Diário de uma Paixão</h2>
                <p><strong>Ano:</strong> 2004</p>
                <p><strong>Gênero:</strong> Romance</p>
                <span class="disponivel">Disponível</span>
                <p class="preco">R$ 10,00</p>
                <a href="Alugar.php?id=2" class="alugar">
                    Alugar
                </a>
            </div>
        </div>
        <div class="filme">
            <img src="templates/img/younghearts.png" alt="Young Hearts">
            <div class="informacoes">
                <h2>Young Hearts</h2>
                <p><strong>Ano:</strong> 2024</p>
                <p><strong>Gênero:</strong> Romance</p>
                <span class="indisponivel">Indisponível</span>
            </div>
        </div>
        <div class="filme">
            <img src="templates/img/10coisasqodeiosobrevc.jpg" alt="10 Coisas que Eu Odeio Sobre Você">
            <div class="informacoes">
                <h2>10 Coisas que Eu Odeio Sobre Você</h2>
                <p><strong>Ano:</strong> 1999</p>
                <p><strong>Gênero:</strong> Romance / Comédia</p>
                <span class="disponivel">Disponível</span>
                <p class="preco">R$ 10,00</p>
                <a href="Alugar.php?id=4" class="alugar">
                    Alugar
                </a>
            </div>
        </div>
        <div class="filme">
            <img src="img/ondas.png" alt="Waves">
            <div class="informacoes">
                <h2>Waves</h2>
                <p><strong>Ano:</strong> 2019</p>
                <p><strong>Gênero:</strong> Drama / Romance</p>
                <span class="indisponivel">Indisponível</span>
            </div>
        </div>
        <?php
        if (isset($_SESSION["filmes"])) {
            foreach ($_SESSION["filmes"] as $indice => $filme) {
        ?>
        <div class="filme">
            <img
                src="<?php echo $filme["foto"]; ?>"
                alt="Poster do filme <?php echo $filme["nome"]; ?>"
            >
            <div class="informacoes">
                <h2><?php echo $filme["nome"]; ?></h2>
                <p>
                   <strong>Ano:</strong>
                    <?php echo $filme["ano"]; ?>
                </p>
                <p>
                    <strong>Gênero:</strong>
                    <?php echo $filme["genero"]; ?>
                </p>

                <?php if ($filme["disponibilidade"] == "Disponível") { ?>

                    <span class="disponivel">
                        Disponível
                    </span>

                    <p class="preco">
                        R$ <?php echo $filme["custo"]; ?>
                    </p>

                <?php } else { ?>

                    <span class="indisponivel">
                        <?php echo $filme["disponibilidade"]; ?>
                    </span>

                <?php } ?>

                <a
                    href="excluir.php?indice=<?php echo $indice; ?>"
                    class="alugar"
                >
                    Excluir
                </a>

            </div>
        </div>

        <?php
            }
        }
        ?>

    </section>

</main>

</body>
</html>
