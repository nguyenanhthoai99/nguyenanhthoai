<html>

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>

    <div style="width: 300px; height: 500px; border: 1px solid black;">
        <ul id="chatbot">
        </ul>
    </div>

    <input type="text" id="chatinput" name="chatinput"><br><br>
    <button type="button" id="chatbutton" onclick="reply()">Click Me!</button>

</body>

</html>

<script>
    var question = 1;

    function ask() {
        if (question == 1) {
            $("#chatbot").append("<li>CHAT BOT: HI TÔI CÓ THỂ GIÚP GÌ CHO BẠN? 1. Báo hàng hỏng 2. Khiếu nại 3. Bảo hành </li>");
        }
        else if (question == 2) {
            $("#chatbot").append("<li>CHAT BOT: BẠN CÒN VẤN ĐỀ GÌ NỮA KHÔNG? 1. Có 2. Không</li>");
        }
    }

    function reply() {
        var userInput = $("#chatinput").val();
        $("#chatbot").append("<li>" + userInput + "</li>");

        var message = "";

        if (question == 1) {
            if (userInput.trim() == "1") {
                message = "Nếu hàng hóa đã mua trong vòng 7 ngày, bạn có thể dổi trả trực tiếp. Liên hệ 123456.";
                question = 2;
            } else if (userInput.trim() == "2") {
                message = "Bạn đã khiếu nại, chúng tôi sẽ ghi nhận";
                question = 2;
            } else if (userInput.trim() == "3") {
                message = "Bạn hay đi tới địa chỉ 1 2 3 4 để bảo hành nếu còn hạn bảo hành.";
                question = 2;
            } else {
                message = "Tôi chưa hiểu câu trả lời của bạn";
                question = 1;
            }
        }
        else if (question == 2) {
            if (userInput.trim() == "1") {
                question = 1;
            } else {
                message = "Chúc bạn một ngày tốt lành";
                question = 3;
            }
        }
        else if (question == 3) {
            return;
        }

        $("#chatbot").append("<li>" + message + "</li>");
        ask();
    }

    // main script
    ask();

</script>