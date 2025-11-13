<?php
require 'nav.php';

// Extraer variables de $data (enviadas por AdminController)
$titulo_calendario = $data['titulo_calendario'] ?? 'Calendario';
$reservas = $data['reservas'] ?? [];
$vista = $data['vista'] ?? 'mes';
/** @var \DateTime $fecha_base */
$fecha_base = $data['fecha_base'];
/** @var \DateTime $fecha_inicio_obj */
$fecha_inicio_obj = $data['fecha_inicio_obj'];
/** @var \DateTime $fecha_fin_obj */
$fecha_fin_obj = $data['fecha_fin_obj'];
/** @var \DateTime $fecha_anterior_nav */
$fecha_anterior_nav = $data['fecha_anterior_nav'];
/** @var \DateTime $fecha_siguiente_nav */
$fecha_siguiente_nav = $data['fecha_siguiente_nav'];

// Mapa de reservas por día
$reservas_por_dia = [];
foreach ($reservas as $res) {
    if (!empty($res['fecha_entrada'])) {
        $reservas_por_dia[$res['fecha_entrada']][] = $res;
    }
    if (!empty($res['fecha_vuelo_salida']) && $res['fecha_vuelo_salida'] !== $res['fecha_entrada']) {
        $reservas_por_dia[$res['fecha_vuelo_salida']][] = $res;
    }
}
?>

<h1 class="display-6 fw-bold mb-4">Calendario de Reservas</h1>

<div class="card shadow-sm border-0 rounded-lg">
    <div class="card-header text-center fs-4 fw-light">
        
        <div class="d-flex justify-content-between align-items-center mb-3">
            <!-- BOTÓN ANTERIOR -->
            <a href="<?php echo APP_URL; ?>/admin/calendar?vista=<?php echo $vista; ?>&ano=<?php echo $fecha_anterior_nav->format('Y'); ?>&mes=<?php echo $fecha_anterior_nav->format('m'); ?>&dia=<?php echo $fecha_anterior_nav->format('d'); ?>" 
               class="btn btn-outline-primary calendar-nav">
                <i class="bi bi-arrow-left"></i> Anterior
            </a>
            
            <span class="fw-bold fs-4"><?php echo htmlspecialchars($titulo_calendario); ?></span>
            
            <!-- BOTÓN SIGUIENTE -->
            <a href="<?php echo APP_URL; ?>/admin/calendar?vista=<?php echo $vista; ?>&ano=<?php echo $fecha_siguiente_nav->format('Y'); ?>&mes=<?php echo $fecha_siguiente_nav->format('m'); ?>&dia=<?php echo $fecha_siguiente_nav->format('d'); ?>" 
               class="btn btn-outline-primary calendar-nav">
                Siguiente <i class="bi bi-arrow-right"></i>
            </a>
        </div>
        
        <div class="btn-group w-100" role="group">
            <a href="<?php echo APP_URL; ?>/admin/calendar?vista=mes&ano=<?php echo $fecha_base->format('Y'); ?>&mes=<?php echo $fecha_base->format('m'); ?>" 
               class="btn btn-outline-secondary <?php if ($vista == 'mes') echo 'active'; ?>">Mes</a>
            <a href="<?php echo APP_URL; ?>/admin/calendar?vista=semana&ano=<?php echo $fecha_base->format('Y'); ?>&mes=<?php echo $fecha_base->format('m'); ?>&dia=<?php echo $fecha_base->format('d'); ?>" 
               class="btn btn-outline-secondary <?php if ($vista == 'semana') echo 'active'; ?>">Semana</a>
            <a href="<?php echo APP_URL; ?>/admin/calendar?vista=dia&ano=<?php echo $fecha_base->format('Y'); ?>&mes=<?php echo $fecha_base->format('m'); ?>&dia=<?php echo $fecha_base->format('d'); ?>" 
               class="btn btn-outline-secondary <?php if ($vista == 'dia') echo 'active'; ?>">Día</a>
        </div>
    </div>
    
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-bordered text-center calendar-table" style="table-layout: fixed;">
                <thead class="table-light">
                    <tr>
                        <th>Lunes</th><th>Martes</th><th>Miércoles</th><th>Jueves</th><th>Viernes</th><th>Sábado</th><th>Domingo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($vista == 'mes'):
                        $dia_actual = clone $fecha_inicio_obj;
                        $dia_actual->modify('monday this week');
                        $dia_fin_grid = clone $fecha_fin_obj;
                        $dia_fin_grid->modify('sunday this week');

                        while ($dia_actual <= $dia_fin_grid):
                            if ($dia_actual->format('N') == 1) echo '<tr>';
                            $clase_css = ($dia_actual->format('m') != $fecha_base->format('m')) ? 'text-muted bg-light' : '';
                            $fecha_iso = $dia_actual->format('Y-m-d');
                    ?>
                            <td class="<?php echo $clase_css; ?>">
                                <div class="cell-day"><?php echo $dia_actual->format('j'); ?></div>
                                <div class="cell-content">
                                    <?php
                                    if (isset($reservas_por_dia[$fecha_iso])):
                                        foreach ($reservas_por_dia[$fecha_iso] as $res):
                                            $es_llegada = ($res['fecha_entrada'] == $fecha_iso);
                                            $color_badge = $es_llegada ? 'bg-success' : 'bg-danger';
                                            $icono = $es_llegada ? '<i class="bi bi-box-arrow-in-down"></i>' : '<i class="bi bi-box-arrow-up"></i>';
                                            $hora = $es_llegada ? ($res['hora_entrada'] ?? '') : ($res['hora_recogida'] ?? '');
                                    ?>
                                            <a href="<?php echo APP_URL; ?>/reserva/editar/<?php echo $res['id_reserva']; ?>" 
                                               class="badge <?php echo $color_badge; ?> text-white d-block mb-1 text-start text-decoration-none">
                                                <?php echo $icono; ?>
                                                <?php echo htmlspecialchars(substr($hora, 0, 5)); ?>
                                                <?php echo htmlspecialchars($res['nombre_hotel']); ?>
                                            </a>
                                    <?php endforeach; endif; ?>
                                </div>
                            </td>
                    <?php
                            if ($dia_actual->format('N') == 7) echo '</tr>';
                            $dia_actual->modify('+1 day');
                        endwhile;
                    else:
                        echo '<tr><td colspan="7">';
                        if (empty($reservas)) {
                            echo '<div class="p-5 text-center text-muted">No hay reservas para ' . ($vista == 'semana' ? 'esta semana.' : 'este día.') . '</div>';
                        } else {
                            echo '<ul class="list-group list-group-flush">';
                            foreach ($reservas as $res) {
                                $es_llegada = !empty($res['fecha_entrada']) && $res['fecha_entrada'] >= $fecha_inicio_obj->format('Y-m-d');
                                $color = $es_llegada ? 'success' : 'danger';
                                $icono = $es_llegada ? '<i class="bi bi-box-arrow-in-down"></i> Llegada' : '<i class="bi bi-box-arrow-up"></i> Salida';
                                $fecha = $es_llegada ? $res['fecha_entrada'] : $res['fecha_vuelo_salida'];
                                $hora = $es_llegada ? ($res['hora_entrada'] ?? '') : ($res['hora_recogida'] ?? '');
                                echo '<li class="list-group-item d-flex justify-content-between align-items-center">';
                                echo "<div><span class='badge bg-$color me-2'>$icono</span><strong>$fecha @ " . htmlspecialchars(substr($hora, 0, 5)) . "</strong> - " . htmlspecialchars($res['nombre_hotel']) . "</div>";
                                echo '<a href="' . APP_URL . '/reserva/editar/' . $res['id_reserva'] . '" class="btn btn-sm btn-outline-secondary">Ver/Editar</a>';
                                echo '</li>';
                            }
                            echo '</ul>';
                        }
                        echo '</td></tr>';
                    endif;
                    ?>
                </tbody>
            </table>
        </div>
