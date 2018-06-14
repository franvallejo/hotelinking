<!-- Login Modal-->
<div class="modal fade" id="ModalLogin" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="">Introduzca sus Datos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="loginForm">
                    <div class="form-group">
                        <label for="loginFormName">Nick Name</label>
                        <input type="text" class="form-control" id="loginFormName" name="userName"
                               placeholder="ej. User1">
                    </div>
                    <div class="form-group">
                        <label for="loginFormPass">Password</label>
                        <input type="password" class="form-control" id="loginFormPass" name="password"
                               placeholder="***********">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="checkUser('login');">Submit</button>
            </div>
        </div>
    </div>
</div>

<!-- Registration Modal -->
<div class="modal fade" id="ModalRegistro" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="">Nuevo Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="registroForm">
                    <div class="form-group">
                        <label for="registroFormName">Nick Name</label>
                        <input type="text" class="form-control" id="registroFormName" placeholder="ej. User1">
                    </div>
                    <div class="form-group">
                        <label for="registroFormPass">Password</label>
                        <input type="password" class="form-control" id="registroFormPass"
                               placeholder="***********">
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="checkUser('registro');">Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Promos List Modal -->
<div class="modal fade" id="ModalPromosList" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="">Listado de Promociones</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">Promo</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Canjear</th>
                    </tr>
                    </thead>
                    <tbody id="modal-body-promo-list">
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="checkPromo('canjear');">Submit</button>
            </div>
        </div>
    </div>
</div>
