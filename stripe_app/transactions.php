<!DOCTYPE html>
<html>
    <?php require_once('header.php'); ?>
    <style type="text/css">
        .btn:focus {
            box-shadow: none;
        }
        #table-body tr {
            background: #e0e0e0;
        }
    </style>
    <body>
        <div class="container mt-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="btn-group" role="group">
                      <button id="customers" class="btn btn-secondary">Customers</button>
                      <button id="transactions" class="btn btn-primary">Transactions</button>
                    </div>
                    <hr />
                    <h1 id="data-name"></h1>
                    <table class="table">
                        <thead>
                            <tr id="header">
                                
                            </tr>
                        </thead>
                        <tbody id="table-body">
                            
                        </tbody>
                    </table>
                    <a href="index.php">Pay Page</a>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.js"></script>
        <script type="text/javascript">
            let customers, transactions, mode = 'transactions';
            window.onload = () => {
                axios.get('db.php?fetch_all=true').then(({data}) => {
                    customers = JSON.parse(data.customers).sort((a,b) => b.created_at > a.created_at);
                    transactions = JSON.parse(data.transactions).sort((a,b) => b.created_at > a.created_at);
                }).then(res => loadData(mode));
            }
            
            document.querySelectorAll('.btn').forEach(btn => {
               btn.addEventListener('click', (e) => {
                   e.target.classList.remove('btn-secondary');
                   e.target.classList.add('btn-primary');
                   if(e.target.id === "customers") {
                       mode = 'customers';
                   }  else mode = 'transactions';
                   loadData(mode);
                    if(e.target.nextElementSibling) {
                        e.target.nextElementSibling.classList.remove('btn-primary');
                        e.target.nextElementSibling.classList.add('btn-secondary');
                    } else {
                        e.target.previousElementSibling.classList.remove('btn-primary');
                        e.target.previousElementSibling.classList.add('btn-secondary');
                    }
                }); 
            });
            
            const loadData = (mode) => {
                let data = "", headers = "";
                if(mode === 'customers') {
                    document.getElementById('data-name').textContent = 'Customers';
                    let header_tags = ['Customer ID', 'Name', 'Email', 'Date'];
                    for(let h of header_tags) {
                        headers += `<th scope='col'>${h}</th>`;
                    }
                    for(let customer of customers) {
                        data += "<tr>";
                        data += `<td>${customer.id}</td>`;
                        data += `<td>${customer.first_name} ${customer.last_name}</td>`;
                        data += `<td>${customer.email}</td>`;
                        data += `<td>${customer.created_at}</td>`;
                        data += "</tr>";
                    }
                } else {
                    document.getElementById('data-name').textContent = 'Transactions';
                    let header_tags = ['Transaction ID', 'Customer', 'Product', 'Amount', 'Currency', 'Status', 'Date'];
                    for(let h of header_tags) {
                        headers += `<th scope='col'>${h}</th>`;
                    }
                    for(let transaction of transactions) {
                        data += "<tr>";
                        data += `<td>${transaction.id}</td>`;
                        data += `<td>${transaction.customer_id}</td>`;
                        data += `<td>${transaction.product}</td>`;
                        data += `<td>${parseInt(transaction.amount).toFixed(2)}</td>`;
                        data += `<td>${transaction.currency.toUpperCase()}</td>`;
                        data += `<td>${transaction.status}</td>`;
                        data += `<td>${transaction.created_at}</td>`;
                        data += "</tr>";
                    }
                }
                document.getElementById("header").innerHTML = headers;
                document.getElementById("table-body").innerHTML = data;
            };
        </script>        
    </body>
</html>
