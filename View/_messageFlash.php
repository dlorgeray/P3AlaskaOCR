<style>
    .alert {
        padding: 20px;
        background-color: #f44336;
        color: white;
        opacity: 1;
        transition: opacity 0.6s;
        margin-bottom: 15px;
        text-align: center;
        width: 100%;
        height: 60px;
    }

    .alert.success {
        background-color: #18bc9c;
    }

    .alert.info {
        background-color: #2196F3;
    }

    .alert.warning {
        background-color: #ff9800;
    }

    .closebtn {
        margin-left: 15px;
        color: white;
        font-weight: bold;
        float: right;
        font-size: 20px;
        line-height: 20px;
        cursor: pointer;
        transition: 0.3s;
    }

    .closebtn:hover {
        color: black;
    }
</style>
<div class="message-flash alert <?= $_SESSION['flash']['type']; ?>">
    <span class="closebtn">X</span>
    <div><?= $_SESSION['flash']['message']; ?></div>
</div>

<script>
    var close = document.getElementsByClassName("closebtn");
    var i;

    for (i = 0; i < close.length; i++) {
        close[i].onclick = function () {
            var div = this.parentElement;
            div.style.opacity = "0";
            setTimeout(function () {
                div.style.display = "none";
            }, 60);
        }
    }
</script>