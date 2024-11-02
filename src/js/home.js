

document.addEventListener('DOMContentLoaded', function () {
    var modal = document.getElementById('myModal');
    var mySecondModalmodal = document.getElementById('mySecondModal');
    var openBtn = document.getElementById('btnNota');
    var openNBtn = document.getElementById('btnEscNota');
    var closeBtn = document.getElementById('closeModalBtn');
    var closeMsgBtn = document.getElementById('closeMsgModalBtn');





    openBtn.onclick = function () {
        modal.style.display = 'block';
    }

    closeBtn.onclick = function () {
        modal.style.display = 'none';
    }

    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = 'none';
            mySecondModalmodal.style.display = 'none';
        }
    }

    openNBtn.onclick = function () {
        modal.style.display = 'none';
        mySecondModalmodal.style.display = 'block';
    }

    closeMsgBtn.onclick = function () {
        mySecondModalmodal.style.display = 'none';
    }

    window.onclick = function (event) {
        if (event.target == modal) {
            mySecondModalmodal.style.display = 'none';
        }
    }

});

