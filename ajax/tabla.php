<?php
header('Content-Type: application/json');
echo '{"tabla":[{"fila":"' . rand(5, 10) . '", "columna":"' . rand(5, 10) . '"}]}';
