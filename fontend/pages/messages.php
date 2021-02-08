<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .chatbox {
            height: 30px;
            width: 200px;
            position: fixed;
            bottom: 0px;
            right: 50px;
            text-align: center;
            z-index: 1;

        }

        .messageframe {
            position: fixed;
            bottom: 2px;
        }

        .chatframe {
            margin-left: 30px;
        }

        .chattitle {
            border: 1px solid #4a90e2;
            color: #fff;
            background-color: #4a90e2;
        }

        .chatbox {
            background-color: #eff0f5;
            width: 300px;
            height: auto;
        }

        .chatbot {
            width: 280px;
            height: 360px;
            overflow: auto;
            margin: 5px;
            list-style-type: none;
        }

        .chatbotcontent {
            width: 300px;
            height: 400px;
            border: 1px solid black;
        }
    </style>
</head>

<body>
    <div class="chatbox">
        <div id="chattitle" class="chattitle">
            <i class="fa fa-comments" aria-hidden="true"></i>Tin Nhắn
        </div>
        <div id="chatbotcontent">
            <div id="chatbot" class="chatbot">
                <div class="chatAdmin">

                </div>
                <div class="chatCustomer">

                </div>
            </div>
            <div class="messageframe">
                <input type="text" id="chatinput" name="chatinput" class="chatframe ">
                <button type="button" id="chatbutton" onclick="reply()">Gửi</button>
            </div>
        </div>
    </div>
</body>

</html>
<script>
    var showChatBox = true;

    $(function() {
        $("#chattitle").click(function() {
            if (showChatBox) {
                showChatBox = false;
                $("#chatbotcontent").hide();
            } else {
                showChatBox = true;
                $("#chatbotcontent").show();
            }

        });
    });

    var question = 1;

    function ask() {
        if (question == 1) {
            $("#chatbot").append("<li>CHAT BOT: HI TÔI CÓ THỂ GIÚP GÌ CHO BẠN? 1. Báo hàng hỏng 2. Khiếu nại 3. Bảo hành </li>");
        } else if (question == 2) {
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
        } else if (question == 2) {
            if (userInput.trim() == "1") {
                question = 1;
            } else {
                message = "Chúc bạn một ngày tốt lành";
                question = 3;
            }
        } else if (question == 3) {
            return;
        }

        $("#chatbot").append("<li>" + message + "</li>");
        ask();
    }
    ask();
</script>