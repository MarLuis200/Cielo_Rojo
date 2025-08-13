
<div class="row">
	<div class="col-md-12">
		<section class="panel">
			<div class="panel-body">

				@if ( !empty ( $personas->id) )

					<div class="mb-3">
						<label for="nombre" class="negrita">Nombre:</label>
						<div>
							<input class="form-control" placeholder="Nombre" required="required" name="nombre" type="text" id="nombre" value="{{ $personas->nombre }}">
						</div>
					</div>

					<div class="mb-3">
						<label for="apellido_paterno" class="negrita">Apellido Materno</label>
						<div>
							<input class="form-control" placeholder="apellido_paterno" required="required" name="apellido_paterno" type="text" id="apellido_paterno" value="{{ $personas->apellido_paterno}}">
						</div>
					</div>

                    <div class="mb-3">
                        <label for="apellido_materno" class="negrita">Apellido Materno</label>
                        <div>
                            <input class="form-control" placeholder="apellido_paterno" required="required" name="apellido_materno" type="text" id="apellido_materno" value="{{ $personas->apellido_materno}}">
                        </div>
                    </div>

					<div class="mb-3">
						<label for="direccion" class="negrita">Direccion:</label>
						<div>
							<input class="form-control" placeholder="Dirección" required="required" name="direccion" type="text" id="direccion" value="{{ $personas->direccion }}">
						</div>
					</div>

                    <div class="mb-3">
                        <label for="correo" class="negrita">Telefono:</label>
                        <div>
                            <input class="form-control" placeholder="telefono" required="required" name="telefono" type="text" id="telefono" value="{{ $personas->telefono}}">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="correo" class="negrita">Correo:</label>
                        <div>
                            <input class="form-control" placeholder="correo" required="required" name="correo" type="text" id="correo" value="{{ $personas->correo}}">
                        </div>
                    </div>

					<div class="mb-3">
						<label for="img" class="negrita">Selecciona una imagen:</label>
						<div>
							<input name="img" type="file" id="img" >
							<br>
							<br>

							@if ( !empty ( $personas->img) )

								<span>Imagen Actual: </span>
								<br>
								<img src="../../../uploads/{{ $personas->img }}" width="200" class="img-fluid">

							@else

								Aún no se ha cargado una imagen para este cliente

							@endif

						</div>

					</div>

					@else

					<div class="mb-3">
						<label for="nombre" class="negrita">Nombre:</label>
						<div>
							<input class="form-control" placeholder="Nombre" required="required" name="nombre" type="text" id="nombre">
						</div>
					</div>

					<div class="mb-3">
						<label for="apellido_paterno" class="negrita">Apellido Paterno:</label>
						<div>
							<input class="form-control" placeholder="Apellido paterno" required="required" name="apellido_paterno" type="text" id="apellido_paterno">
						</div>
					</div>
                    <div class="mb-3">
                        <label for="apellido_materno" class="negrita">Apellido Materno:</label>
                        <div>
                            <input class="form-control" placeholder="Apellido materno" required="required" name="apellido_materno" type="text" id="apellido_materno">
                        </div>
                    </div>

					<div class="mb-3">
						<label for="direccion" class="negrita">Dirección:</label>
						<div>
							<input class="form-control" placeholder="Dirección" required="direccion" name="direccion" type="text" id="direccion">
						</div>
					</div>

                    <div class="mb-3">
                        <label for="telefono" class="negrita">Teléfono:</label>
                        <div>
                            <input class="form-control" placeholder="Teléfono" required="telefono" name="telefono" type="text" id="telefono">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="correo" class="negrita">Correo:</label>
                        <div>
                            <input class="form-control" placeholder="Correo" required="required" name="correo" type="text" id="correo">
                        </div>
                    </div>

					<div class="mb-3">
						<label for="img" class="negrita">Selecciona una imagen:</label>
						<div>
							<input name="img" type="file" id="img">
						</div>
					</div>

				@endif

				<button type="submit" class="btn btn-info">Guardar</button>
				<a href="{{ route('admin.personas.index') }}" class="btn btn-warning">Cancelar</a>

				<br>
				<br>

			</div>
		</section>
	</div>
</div>
