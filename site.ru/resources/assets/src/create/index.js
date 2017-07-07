module.exports = function () {

    let newEmployer = {},
        currentDollar = document.querySelector('[data-currency="dollar"]').dataset.usdcurs;

    function readFile() {
    
        if (this.files && this.files[0]) {

            if( this.files[0].type !== "image/jpeg" ) {

                Materialize.toast('Должно быть изображение!', 4000) ;
                return;
            }
            
            var FR= new FileReader();
            
            FR.addEventListener("load", function(e) {

                $(document.getElementById("upload-photo")
                .parentNode).css({
                       "display": "block" 
                });

                document.getElementById("upload-photo").src = e.target.result;
                newEmployer.photo = e.target.result;
            }); 
            
            FR.readAsDataURL( this.files[0] );
            newEmployer.img   = this.files[0];  
        }
    }
    document.getElementById("upload-input").addEventListener("change", readFile);

    let submitCreateEmployer = document.querySelector('.submit-employer');
    submitCreateEmployer.addEventListener('click', submitEmployer);

    function submitEmployer(e) {

        function writenNewEmployer(newEmployer) {

            newEmployer.firstName = document.getElementById('first_name').value;
            newEmployer.lastName  = document.getElementById('last_name').value;
            newEmployer.position  = document.getElementById('position')
                .parentNode.querySelector('option[value="'+ document.getElementById('position').value +'"]').textContent;
            newEmployer.salary    = document.getElementById('salary').value;
        }

        writenNewEmployer(newEmployer);

        function getFormData(newEmployer) {
            var form_data = new FormData();

            form_data.append( 'firstName', newEmployer.firstName );
            form_data.append( 'lastName', newEmployer.lastName );
            form_data.append( 'position', document.getElementById('position').value );
            form_data.append( 'salary', newEmployer.salary );
            form_data.append( 'img', newEmployer.img );
            return form_data;
        }
        let form_data = getFormData(newEmployer);

        $.ajax({
            method: "POST",
            url: "/create-employer",
            cache: false,
            dataType: 'json',
            processData: false,
            contentType: false,
            data: form_data
        })
        .done(function(data) {
            if(data.status == 200) {

                Materialize.toast('Новый сотрудник добавлен!', 4000) ;
                renderAddRowTable(data);
                resetForm();
                return;
            }
            else if(data.status == 500) {
                Materialize.toast('Ошибка. Форма не валидна!', 4000) ;
                return;
            }
            Materialize.toast('Ошибка. Что-то не так!', 4000) ;
        });
    }

    function resetForm() {

        document.querySelector(".add-employer").reset();
        $(document.getElementById("upload-photo")
        .parentNode).css({
                "display": "" 
        });
        document.getElementById("upload-photo").src = '';
    }

    function renderAddRowTable(data) {

        let salary = null;

        if(window.currency === "dollar") {
            
            salary = parseInt(newEmployer.salary) / parseInt(currentDollar);
            salary = Math.round(salary * 100) / 100;
        }

        let template = `<td>
                            <a href="${ newEmployer.photo }" 
                            data-lightbox="image-1" data-title="${ newEmployer.firstName + ' ' + newEmployer.lastName }">
                                <img class="mini-photo" src="${ newEmployer.photo ? newEmployer.photo : '/img/user_profile.jpg' }">
                            </a>
                        </td>
                        <td>${ newEmployer.firstName + " " + newEmployer.lastName }</td>
                        <td>${ newEmployer.position }</td>
                        <td>нет</td>
                        <td class="data-salary" data-rub-salary="${ newEmployer.salary }">${ salary ? salary : newEmployer.salary }</td>`;
        let row   = document.createElement('tr'),
            table = document.querySelector('.table-workers').querySelector('tbody');

        row.innerHTML = template;
        row.dataset.workerId = data.worker.id;
        table.insertBefore(row, table.children[0]);
    }
};