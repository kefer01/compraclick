<div class="contenedor admin">
    <h1 class="nombre-pagina">Administracion de usuarios</h1>
    <div class="">
        <p class="descripcion-pagina">Administra y supervisa los usuarios</p>
        <form class=""  method="POST">
            <table class="tabla-usuarios">
                <thead>
                    <tr class = "tr">
                        <th class = "th">Codigo</th>
                        <th class = "th">Usuario</th>
                        <th class = "th">Nombre</th>
                        <th class = "th">Estado</th>
                        <th class = "th">Opcion</th>
                    </tr>
                </thead> 
                <tbody class="tbody">
                    <?php foreach ($usuarios as $usuario): ?>
                    <tr class = "tr">
                        <td class = "td"> <?php echo $usuario->id; ?> </td>
                        <td class = "td"> <?php echo $usuario->usuario; ?> </td>
                        <td class = "td"> <?php echo $usuario->p_nombre." ".$usuario->p_apellido; ?> </td>
                        <td class = "td"> <?php
                        if ($usuario->estado == 1){
                            echo 'Activo'; 
                        } 
                        else if ($usuario->estado == 0){
                            echo 'Inactivo'; 
                        } 
                        ?> </td>

                        <td class = "td"><a class = "boton-naranja" href="editar_perfil?id=<?php echo $usuario->id; ?>" class="boton">Modificar</a></td>
                        <td><?php
                        //if ($usuario->estado == 1){
                        //    echo '<input type="submit" class="boton" value="Desactivar">'; 
                        //} 
                        //else if ($usuario->estado == 0){
                        //    echo '<input type="submit" class="boton" value="Activar">'; 
                        //} 
                        ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </form>
    </div><!-- .contenedor-sm  -->
</div>