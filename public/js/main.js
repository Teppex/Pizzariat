const pizzeriat = document.getElementById('pizzeriat');

if(pizzeriat) {
    pizzeriat.addEventListener('click', e =>{
        if(e.target.className === 'btn btn-danger delete-pizzeria') {
            if(confirm('Oletko varma?')) {
                const id = e.target.getAttribute('data-id');

                fetch(`/pizzeria/delete/${id}`, {
                    method: 'DELETE'
                }).then(res => window.location.reload());
            }
        }
    });
}