<html>
<head>
    <title>Тест</title>
    <script>
        async function send(event) {
            let response = await fetch("/data.php", {
                method: "POST",
                body: new FormData(event.target)
            })
            let data = await response.json()
            document.querySelector(".data").innerHTML = data.response
        }

        document.addEventListener("DOMContentLoaded", function () {

            document.querySelector(".formSend").addEventListener("submit", e => {
                e.preventDefault();
                e.stopPropagation();
                send(e);
                return false;
            })

        })
    </script>
</head>
<body>
<div class="data">
    <form action="/send.php" class="formSend" method="post">
        <label for="senddata">Текст</label>
        <input type="text" name="senddata" id="senddata">
        <input type="submit">
    </form>
</div>

</body>
</html>