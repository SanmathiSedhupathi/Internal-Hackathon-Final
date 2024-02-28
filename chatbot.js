const chatBody=document.querySelector(".chat-body");
const txtInput=document.querySelector("#txtInput");
const send=document.querySelector(".send");
var faq = document.getElementsByClassName("faq-page");
var i;


send.addEventListener("click", () => renderUserMessage());

txtInput.addEventListener("keyup",(event) => {
    if(event.keyCode === 13) {
        renderUserMessage();
    }
});
const renderUserMessage = () => {
    const userInput = txtInput.value;
    renderMessageEle(userInput,"user");
    txtInput.value = "";
    setTimeout(() => {
        renderChatbotResponse(userInput);
        setScrollPosition();
    },600);
};

const renderChatbotResponse = (userInput) => {
    const res=getCahtbotResponse(userInput);
    renderMessageEle(res);
};

const renderMessageEle = (txt,type) => {
    let className = "user-message";
    if(type !== "user") {
        className = "chatbot-message";
    }
    const messageEle = document.createElement("div");
    const txtNode = document.createTextNode(txt);
    messageEle.classList.add(className);
    messageEle.append(txtNode);
    chatBody.append(messageEle);
};

const getCahtbotResponse = (userInput) => {
    return responseObj[userInput]==undefined?"Please try something else":responseObj[userInput];
};
const setScrollPosition = () => {
    if(chatBody.scrollHeight > 0) {
        chatBody.scrollTop = chatBody.scrollHeight;
    }
};

for (i = 0; i < faq.length; i++) {
    faq[i].addEventListener("click", function () {
        /* Toggle between adding and removing the "active" class,
        to highlight the button that controls the panel */
        this.classList.toggle("active");

        /* Toggle between hiding and showing the active panel */
        var body = this.nextElementSibling;
        if (body.style.display === "block") {
            body.style.display = "none";
        } else {
            body.style.display = "block";
        }
    });
}