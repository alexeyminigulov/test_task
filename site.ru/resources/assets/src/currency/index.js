module.exports = function () {

    let dropdownCurrency = document.querySelector('.dropdown-button.btn'),
        currencys = dropdownCurrency.parentNode.querySelectorAll('li a'),
        listSalary,
        listPremium,
        thIconSalary = document.querySelectorAll('.icon-salary');
    currencys = [].slice.call( currencys );
    thIconSalary = [].slice.call( thIconSalary );

    currencys.forEach( (val) => {

        val.addEventListener( 'click', changeCurrency );
    } );

    function changeCurrency(e) {

        let currency = e.target.dataset.currency;

        listSalary = document.getElementsByClassName('data-salary');
        listPremium = document.getElementsByClassName('data-premium');
        listSalary = [].slice.call( listSalary );
        listPremium = [].slice.call( listPremium )

        renderIconCurrency(currency);

        if( currency == "rub" ) {

            listSalary.forEach(function(element) {

                let salary = element.dataset.rubSalary;
                element.textContent = salary;
            } );

            listPremium.forEach(function(element) {

                let premium = element.dataset.rubPremium;
                element.textContent = premium;
            } );
            window.currency = "rub";
            
        } else if(currency == 'dollar') {

            let dollar = e.target.dataset.usdcurs;

            listSalary.forEach(function(element) {
                let salary = parseInt(element.dataset.rubSalary) / parseInt(dollar);
                salary = Math.round(salary * 100) / 100;
                element.textContent = salary;
            } );

            listPremium.forEach(function(element) {
                let premium = parseInt(element.dataset.rubPremium) / parseInt(dollar);
                premium = Math.round(premium * 100) / 100;
                element.textContent = premium;
            } );
            window.currency = "dollar";
        }

        function renderIconCurrency(currency) {

            if(currency == 'rub') {

                dropdownCurrency.innerHTML = 'Вылюта, <i class="fa fa-rub" aria-hidden="true"></i>';
                thIconSalary.forEach((elem) => {
                    elem.innerHTML = 'Зарплата, <i class="fa fa-rub" aria-hidden="true"></i>';
                });
            }
            else {

                dropdownCurrency.innerHTML = 'Вылюта, <i class="fa fa-usd" aria-hidden="true"></i>';                
                thIconSalary.forEach((elem) => {
                    elem.innerHTML = 'Зарплата, <i class="fa fa-usd" aria-hidden="true"></i>';
                });
            }
        }
    }
};