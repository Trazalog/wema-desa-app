<?php $this->extend('templates/admin_template') ?>
<?= $this->section('content') ?>


<div class="row align-items-center mt-3">
                                    <div class="col-md-4 ">
                                      <div class="form-group">
                                        <p id="persona_id" style="margin-top: -19px;margin-bottom: -7px; font-style: italic;" hidden></p>
                                        <label>Apellidos <strong class="text-danger">*</strong>: </label>
                                        <div class="input-group">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                          </div>
                                          <input type="text" class="form-control requerido" id="apellidos" name="apellidos" value="<?php $listadoClientes[0]->id_tributario?>">
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-md-4">
                                      <div class="form-group">
                                        <label>Nombres <strong class="text-danger">*</strong>: </label>
                                        <div class="input-group">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                          </div>
                                          <input type="text" class="form-control requerido" id="nombres" name="nombres" value="<?php $listadoClientes[0]->nombres?>">
                                        </div>
                                      </div>
                                    </div>
</div>
