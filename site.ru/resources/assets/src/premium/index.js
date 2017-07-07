module.exports = function () {

    let newPremium = {},
        currentDollar = document.querySelector('[data-currency="dollar"]').dataset.usdcurs;

    let submitAddPremium = document.getElementById('submit-add-premium');
    submitAddPremium.addEventListener('click', submitPayment);

    function submitPayment(e) {

        function writenNewPremium(newPremium) {

            newPremium.date         = document.querySelector('.datepicker').value;
            newPremium.profession   = document.querySelector('.add-premium select.profession').value;
            newPremium.premium      = document.getElementById('premium').value;
        }

        writenNewPremium(newPremium);

        function getFormData(newPremium) {
            var form_data = new FormData();

            for(prop in newPremium) {
                form_data.append( prop, newPremium[prop] );
            }
            return form_data;
        }
        let form_data = getFormData(newPremium);

        $.ajax({
            method: "POST",
            url: "/add-premium",
            cache: false,
            dataType: 'json',
            processData: false,
            contentType: false,
            data: form_data
        })
        .done(function(data) {
            if(data.status == 200) {

                Materialize.toast('Премия добавлена!', 4000) ;
                renderAddRowTable(data);
                resetForm();
                console.log(data);
                return;
            }
            else if(data.status == 500) {
                let msg = data.msg ? data.msg : 'Ошибка. Форма не валидна!';
                Materialize.toast(msg, 4000) ;
                return;
            }
            Materialize.toast('Ошибка. Что-то не так!', 4000) ;
        });
    }

    function renderAddRowTable(data) {

        let premium = data.premium,
            workers = data.workers,
            table = document.querySelector('.table-workers').querySelector('tbody');

        workers.forEach(function(worker) {
            let template = setTemplate(premium, worker),
                row      = document.createElement('tr'),
                oldElement = document.querySelector('tbody tr[data-worker-id="' + worker.id + '"]');

            row.innerHTML = template;
        
            if( oldElement ) {
                oldElement.parentNode.removeChild(oldElement);
            }
            table.insertBefore(row, table.children[0]);
        });
    }

    function setTemplate(premium, worker) {

        let salaryDollar = null,
            premiumDollar = null;

        if(window.currency === "dollar") {
            
            salaryDollar = parseInt(worker.salary) / parseInt(currentDollar);
            salaryDollar = Math.round(salaryDollar * 100) / 100;

            premiumDollar = parseInt(premium) / parseInt(currentDollar);
            premiumDollar = Math.round(premiumDollar * 100) / 100;
        }

        worker.photo = JSON.parse(worker.photo);
        return `<td>
                    <a href="${ worker.photo ? '/img/'+ worker.photo.medium : '/img/user_profile.jpg' }" 
                    data-lightbox="image-1" data-title="${ worker.first_name + ' ' + worker.last_name }">
                        <img class="mini-photo" src="${ worker.photo ? '/img/'+ worker.photo.min : '/img/user_profile.jpg' }">
                    </a>
                </td>
                <td>${ worker.first_name + " " + worker.last_name }</td>
                <td>${ worker.profession }</td>
                <td class="data-premium" data-rub-premium="${ premium }">${ premiumDollar ? premiumDollar : premium }</td>
                <td class="data-salary" data-rub-salary="${ worker.salary }">${ salaryDollar ? salaryDollar : worker.salary }</td>`;
    }

    function resetForm() {

        document.querySelector(".add-employer").reset();
        $(document.getElementById("upload-photo")
        .parentNode).css({
                "display": "" 
        });
        document.getElementById("upload-photo").src = '';
    }
};