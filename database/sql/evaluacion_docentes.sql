-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-05-2025 a las 19:05:33
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `evaluacion_docentes`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `ActualizarActaCompromiso` (IN `in_id_acta` INT, IN `in_retroalimentacion` TEXT, IN `in_fecha_generacion` DATE)   BEGIN
    UPDATE Acta_Compromiso
    SET retroalimentacion = in_retroalimentacion,
        fecha_generacion = in_fecha_generacion
    WHERE id_acta = in_id_acta;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ActualizarAsignacionCursoDocentePeriodo` (IN `in_id_asignacion` INT, IN `in_id_curso` INT, IN `in_id_docente` INT, IN `in_id_periodo` INT)   BEGIN
    UPDATE Curso_Docente_Periodo
    SET id_curso = in_id_curso,
        id_docente = in_id_docente,
        id_periodo = in_id_periodo
    WHERE id_asignacion = in_id_asignacion;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ActualizarCurso` (IN `in_id_curso` INT, IN `in_codigo` VARCHAR(50), IN `in_nombre` VARCHAR(255), IN `in_id_programa` INT)   BEGIN
    UPDATE Cursos
    SET codigo = in_codigo,
        nombre = in_nombre,
        id_programa = in_id_programa
    WHERE id_curso = in_id_curso;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ActualizarDocente` (IN `in_id_docente` INT, IN `in_id_usuario` INT, IN `in_cod_docente` VARCHAR(50), IN `in_nombre` VARCHAR(255), IN `in_correo` VARCHAR(255))   BEGIN
    UPDATE Docente
    SET id_usuario = in_id_usuario,
        cod_docente = in_cod_docente,
        nombre = in_nombre,
        correo = in_correo
    WHERE id_docente = in_id_docente;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ActualizarEstudiante` (IN `in_id_estudiante` INT, IN `in_nombre` VARCHAR(255), IN `in_correo` VARCHAR(255), IN `in_semestre` INT, IN `in_id_programa` INT)   BEGIN
    UPDATE Estudiantes
    SET nombre = in_nombre,
        correo = in_correo,
        semestre = in_semestre,
        id_programa = in_id_programa
    WHERE id_estudiante = in_id_estudiante;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ActualizarFacultad` (IN `in_id_facultad` INT, IN `in_nombre` VARCHAR(100), IN `in_id_coordinacion` INT)   BEGIN
    UPDATE Facultad
    SET nombre = in_nombre,
        id_coordinacion = in_id_coordinacion
    WHERE id_facultad = in_id_facultad;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ActualizarNotasEvaluacion` (IN `in_id_evaluacion` INT, IN `in_autoevaluacion` DECIMAL(3,2), IN `in_evaluacion_decano` DECIMAL(3,2), IN `in_evaluacion_estudiantes` DECIMAL(3,2))   BEGIN
    UPDATE Evaluaciones
    SET autoevaluacion = in_autoevaluacion,
        evaluacion_decano = in_evaluacion_decano,
        evaluacion_estudiantes = in_evaluacion_estudiantes,
        fecha_evaluacion = CURRENT_TIMESTAMP
    WHERE id_evaluacion = in_id_evaluacion;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ActualizarPasswordUsuario` (IN `in_id_usuario` INT, IN `in_contrasena` VARCHAR(255))   BEGIN
    UPDATE Usuarios
    SET contrasena = in_contrasena,
        fecha_actualizacion = CURRENT_TIMESTAMP
    WHERE id_usuario = in_id_usuario;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ActualizarPeriodoAcademico` (IN `in_id_periodo` INT, IN `in_nombre` VARCHAR(50), IN `in_fecha_inicio` DATE, IN `in_fecha_fin` DATE, IN `in_activo` BOOLEAN)   BEGIN
    UPDATE Periodos_Academicos
    SET nombre = in_nombre,
        fecha_inicio = in_fecha_inicio,
        fecha_fin = in_fecha_fin,
        activo = in_activo
    WHERE id_periodo = in_id_periodo;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ActualizarPlanMejora` (IN `in_id_plan_mejora` INT, IN `in_objetivo` TEXT, IN `in_progreso` INT, IN `in_estado` ENUM('Activo','Cerrado','Pendiente','Cancelado'), IN `in_fecha_inicio` DATE, IN `in_fecha_fin_prevista` DATE)   BEGIN
    UPDATE Plan_De_Mejora
    SET objetivo = in_objetivo,
        progreso = in_progreso,
        estado = in_estado,
        fecha_inicio = in_fecha_inicio,
        fecha_fin_prevista = in_fecha_fin_prevista
    WHERE id_plan_mejora = in_id_plan_mejora;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ActualizarPrograma` (IN `in_id_programa` INT, IN `in_nombre` VARCHAR(255), IN `in_id_facultad` INT)   BEGIN
    UPDATE Programas
    SET nombre = in_nombre,
        id_facultad = in_id_facultad
    WHERE id_programa = in_id_programa;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ActualizarUsuarioInfo` (IN `in_id_usuario` INT, IN `in_nombre` VARCHAR(255), IN `in_apellido` VARCHAR(255), IN `in_correo` VARCHAR(255), IN `in_id_rol` INT, IN `in_tipo_usuario` ENUM('docente','coordinador','administrador'), IN `in_activo` BOOLEAN)   BEGIN
    UPDATE Usuarios
    SET nombre = in_nombre,
        apellido = in_apellido,  -- Agregar este campo
        correo = in_correo,
        id_rol = in_id_rol,
        tipo_usuario = in_tipo_usuario,
        activo = in_activo,
        fecha_actualizacion = CURRENT_TIMESTAMP
    WHERE id_usuario = in_id_usuario;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ActualizarUsuarioInfo2` (IN `in_id_usuario` INT, IN `in_nombre` VARCHAR(255), IN `in_correo` VARCHAR(255), IN `in_id_rol` INT, IN `in_tipo_usuario` ENUM('docente','coordinador','administrador'), IN `in_activo` BOOLEAN)   BEGIN
    UPDATE Usuarios
    SET nombre = in_nombre,
        correo = in_correo,
        id_rol = in_id_rol,
        tipo_usuario = in_tipo_usuario,
        activo = in_activo,
        fecha_actualizacion = CURRENT_TIMESTAMP
    WHERE id_usuario = in_id_usuario;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `AgregarComentario` (IN `in_id_evaluacion` INT, IN `in_tipo` ENUM('Observación','Sugerencia','Crítica','Reconocimiento','Queja','General'), IN `in_comentario` TEXT, IN `in_origen` ENUM('Estudiante','Decano','Autoevaluacion','Coordinador'), OUT `out_nuevo_id` INT)   BEGIN
    INSERT INTO Comentarios (id_evaluacion, tipo, comentario, origen)
    VALUES (in_id_evaluacion, in_tipo, in_comentario, in_origen);
    SET out_nuevo_id = LAST_INSERT_ID();
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `AsignarCursoDocentePeriodo` (IN `in_id_curso` INT, IN `in_id_docente` INT, IN `in_id_periodo` INT, OUT `out_nueva_asignacion_id` INT)   BEGIN
    INSERT INTO Curso_Docente_Periodo (id_curso, id_docente, id_periodo)
    VALUES (in_id_curso, in_id_docente, in_id_periodo);
    SET out_nueva_asignacion_id = LAST_INSERT_ID();
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `BuscarDocente` (IN `terminoBusqueda` VARCHAR(100))   BEGIN
    SELECT 
        d.id_docente,
        u.nombre AS nombre_docente,
        u.apellido as apellido_docente,
        u.identificacion as 
        identificacion_docente,
        d.cod_docente,
        p.nombre AS programa,
        f.nombre AS facultad,
        e.promedio_total,
        e.autoevaluacion,
        e.evaluacion_decano,
        e.evaluacion_estudiantes,
        c.nombre AS curso
    FROM Docente d
    INNER JOIN Usuarios u ON d.id_usuario = u.id_usuario
    LEFT JOIN Programas p ON d.id_docente = p.id_docente
    LEFT JOIN Facultad f ON p.id_facultad = f.id_facultad
    LEFT JOIN Cursos c ON c.id_docente = d.id_docente
    LEFT JOIN Evaluaciones e ON e.id_docente = d.id_docente AND d.id_docente = c.id_docente
    
    ORDER BY u.nombre ASC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `BuscarDocentePorCodigo` (IN `codigo_busqueda` VARCHAR(50))   BEGIN
    SELECT *
    FROM docentes
    WHERE cod_docente LIKE CONCAT('%', codigo_busqueda, '%');
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `BuscarDocentesBajoDesempeno` ()   SELECT 
    d.id_docente,
    u.nombre AS nombre_docente,
    u.correo AS correo_docente,
    p.nombre AS nombre_programa,
    f.nombre AS nombre_facultad,
    c.nombre AS nombre_curso,
    u.identificacion AS identificacion_docente,
    e.promedio_total
FROM 
    Evaluaciones e
INNER JOIN Docente d ON e.id_docente = d.id_docente
INNER JOIN Usuarios u ON d.id_usuario = u.id_usuario
INNER JOIN Cursos c ON e.id_curso = c.id_curso
INNER JOIN Programas p ON c.id_programa = p.id_programa
INNER JOIN Facultad f ON p.id_facultad = f.id_facultad
WHERE 
    e.promedio_total < 4.0
ORDER BY 
    u.nombre ASC$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `BuscarDocentesBajoDesempenosss` ()   BEGIN
    SELECT 
        d.id_docente,
        u.nombre AS nombre_docente,
        u.apellido AS apellido_docente,
        u.correo AS correo_docente,
        u.identificacion AS identificacion_docente,
        p.nombre AS nombre_programa,
        f.nombre AS nombre_facultad,
        e.promedio_total
    FROM Evaluaciones e
    INNER JOIN Docente d ON e.id_docente = d.id_docente
    INNER JOIN Usuarios u ON d.id_usuario = u.id_usuario
    INNER JOIN Programas p ON p.id_docente = d.id_docente
    INNER JOIN Facultad f ON p.id_facultad = f.id_facultad
    WHERE e.promedio_total < 4.0
    ORDER BY u.nombre ASC;
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `CambiarEstadoActivoUsuario` (IN `in_id_usuario` INT, IN `in_activo` BOOLEAN)   BEGIN
    UPDATE Usuarios
    SET activo = in_activo,
        fecha_actualizacion = CURRENT_TIMESTAMP
    WHERE id_usuario = in_id_usuario;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `CrearActaCompromiso` (IN `in_id_evaluacion` INT, IN `in_retroalimentacion` TEXT, IN `in_fecha_generacion` DATE, OUT `out_nuevo_id` INT)   BEGIN
    INSERT INTO Acta_Compromiso (id_evaluacion, retroalimentacion, fecha_generacion)
    VALUES (in_id_evaluacion, in_retroalimentacion, in_fecha_generacion);
    SET out_nuevo_id = LAST_INSERT_ID();
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `CrearCurso` (IN `in_codigo` VARCHAR(50), IN `in_nombre` VARCHAR(255), IN `in_id_programa` INT, OUT `out_nuevo_id` INT)   BEGIN
    INSERT INTO Cursos (codigo, nombre, id_programa)
    VALUES (in_codigo, in_nombre, in_id_programa);
    SET out_nuevo_id = LAST_INSERT_ID();
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `CrearDocente` (OUT `in_id_usuario` INT, IN `in_cod_docente` VARCHAR(50), IN `in_nombre` VARCHAR(255), IN `in_correo` VARCHAR(255), OUT `out_nuevo_id` INT)   BEGIN
    INSERT INTO Docente (id_usuario, cod_docente, nombre, correo)
    VALUES (in_id_usuario, in_cod_docente, in_nombre, in_correo);
    SET out_nuevo_id = LAST_INSERT_ID();
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `CrearEstudiante` (IN `in_nombre` VARCHAR(255), IN `in_correo` VARCHAR(255), IN `in_semestre` INT, IN `in_id_programa` INT, OUT `out_nuevo_id` INT)   BEGIN
    INSERT INTO Estudiantes (nombre, correo, semestre, id_programa)
    VALUES (in_nombre, in_correo, in_semestre, in_id_programa);
    SET out_nuevo_id = LAST_INSERT_ID();
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `CrearFacultad` (IN `in_nombre` VARCHAR(100), IN `in_id_coordinacion` INT, OUT `out_nuevo_id` INT)   BEGIN
    INSERT INTO Facultad (nombre, id_coordinacion)
    VALUES (in_nombre, in_id_coordinacion);
    SET out_nuevo_id = LAST_INSERT_ID();
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `CrearPeriodoAcademico` (IN `in_nombre` VARCHAR(50), IN `in_fecha_inicio` DATE, IN `in_fecha_fin` DATE, IN `in_activo` BOOLEAN, OUT `out_nuevo_id` INT)   BEGIN
    INSERT INTO Periodos_Academicos (nombre, fecha_inicio, fecha_fin, activo)
    VALUES (in_nombre, in_fecha_inicio, in_fecha_fin, in_activo);
    SET out_nuevo_id = LAST_INSERT_ID();
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `CrearPlanMejora` (IN `in_id_acta` INT, IN `in_objetivo` TEXT, IN `in_fecha_inicio` DATE, IN `in_fecha_fin_prevista` DATE, OUT `out_nuevo_id` INT)   BEGIN
    INSERT INTO Plan_De_Mejora (id_acta, objetivo, estado, fecha_inicio, fecha_fin_prevista)
    VALUES (in_id_acta, in_objetivo, 'Pendiente', in_fecha_inicio, in_fecha_fin_prevista);
    SET out_nuevo_id = LAST_INSERT_ID();
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `CrearPrograma` (IN `in_nombre` VARCHAR(255), IN `in_id_facultad` INT, OUT `out_nuevo_id` INT)   BEGIN
    INSERT INTO Programas (nombre, id_facultad)
    VALUES (in_nombre, in_id_facultad);
    SET out_nuevo_id = LAST_INSERT_ID();
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `CrearUsuario` (IN `p_id_rol` INT, IN `p_activo` BOOLEAN, IN `p_nombre` VARCHAR(255), IN `p_apellido` VARCHAR(255), IN `p_correo` VARCHAR(255), IN `p_contrasena` VARCHAR(255), IN `p_identificacion` VARCHAR(255), IN `p_tipo_usuario` ENUM('docente','coordinador','administrador'))   BEGIN
    INSERT INTO Usuarios (
        id_rol,
        activo,
        nombre,
        apellido,
        correo,
        contrasena,
        identificacion,
        tipo_usuario
    )
    VALUES (
        p_id_rol,
        p_activo,
        p_nombre,
        p_apellido,
        p_correo,
        p_contrasena,
        p_identificacion,
        p_tipo_usuario
    );
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `CreateActaCompromiso` (IN `p_fecha_generacion` DATE, IN `p_nombre_docente` VARCHAR(255), IN `p_apellido_docente` VARCHAR(255), IN `p_identificacion_docente` VARCHAR(20), IN `p_curso` VARCHAR(255), IN `p_promedio_total` DECIMAL(3,2), IN `p_retroalimentacion` TEXT)   BEGIN
    DECLARE v_numero_acta VARCHAR(255);

    -- Generar número de acta único
    SET v_numero_acta = CONCAT('ACTA-', UUID());

    -- Insertar acta
    INSERT INTO Acta_Compromiso (
        numero_acta,
        fecha_generacion,
        nombre_docente,
        apellido_docente,
        identificacion_docente,
        curso,
        promedio_total,
        retroalimentacion,
        firma,
        created_at,
        updated_at
    ) VALUES (
        v_numero_acta,
        p_fecha_generacion,
        p_nombre_docente,
        p_apellido_docente,
        p_identificacion_docente,
        p_curso,
        p_promedio_total,
        p_retroalimentacion,
        NULL,
        NOW(),
        NOW()
    );

    -- Retornar el acta insertada
    SELECT * FROM Acta_Compromiso WHERE id = LAST_INSERT_ID();
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `DeleteActaCompromiso` (IN `actaId` INT)   BEGIN
    DELETE FROM acta_compromiso WHERE id = actaId;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `DesasignarCursoDocentePeriodo` (IN `in_id_asignacion` INT)   BEGIN
    DELETE FROM Curso_Docente_Periodo WHERE id_asignacion = in_id_asignacion;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `EliminarComentario` (IN `in_id_comentario` INT)   BEGIN
    DELETE FROM Comentarios WHERE id_comentario = in_id_comentario;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `EliminarCurso` (IN `in_id_curso` INT)   BEGIN
    DELETE FROM Cursos WHERE id_curso = in_id_curso;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `EliminarDocente` (IN `in_id_docente` INT)   BEGIN
    DELETE FROM Docente WHERE id_docente = in_id_docente;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `EliminarEstudiante` (IN `in_id_estudiante` INT)   BEGIN
    DELETE FROM Estudiantes WHERE id_estudiante = in_id_estudiante;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `EliminarFacultad` (IN `in_id_facultad` INT)   BEGIN
    DELETE FROM Facultad WHERE id_facultad = in_id_facultad;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `EliminarPeriodoAcademico` (IN `in_id_periodo` INT)   BEGIN
    DELETE FROM Periodos_Academicos WHERE id_periodo = in_id_periodo;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `EliminarPrograma` (IN `in_id_programa` INT)   BEGIN
    DELETE FROM Programas WHERE id_programa = in_id_programa;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `EliminarUsuario` (IN `in_id_usuario` INT)   BEGIN
    DELETE FROM Usuarios WHERE id_usuario = in_id_usuario;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminar_acta` (IN `p_id` INT)   BEGIN
    DELETE FROM acta_compromiso WHERE id = p_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetActaCompromisoById` (IN `actaId` INT)   BEGIN
    SELECT * FROM acta_compromiso WHERE id = actaId;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetActasCompromiso` ()   BEGIN
    -- Tu lógica SQL aquí
    SELECT * FROM acta_compromiso;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetEvaluacionesCompletas` ()   BEGIN
    -- Seleccionar todas las evaluaciones con el porcentaje de completado
    SELECT 
        e.id_evaluacion, 
        e.total_tareas, 
        e.tareas_completadas, 
        (e.tareas_completadas / e.total_tareas) * 100 AS porcentaje_completado
    FROM 
        evaluaciones e
    WHERE 
        e.tareas_completadas = e.total_tareas;  -- Solo evaluaciones completas
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetEvaluacionesPendientes` ()   BEGIN
    SELECT COUNT(*) AS evaluaciones_completas
    FROM evaluaciones E
    INNER JOIN periodos_academicos P ON E.id_periodo = P.id_periodo
    WHERE P.id_periodo = p_id_periodo
      AND E.autoevaluacion IS NOT NULL
      AND E.evaluacion_decano IS NOT NULL
      AND E.evaluacion_estudiantes IS NOT NULL;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertarComentario` (IN `p_id_comentario` INT, IN `p_tipo` VARCHAR(50), IN `p_id_docente` INT, IN `p_id_programa` INT, IN `p_id_coordinacion` INT, IN `p_comentario1` TEXT, IN `p_comentario2` TEXT)   BEGIN
    INSERT INTO comentarios (
        id_comentario, tipo, id_docente, id_programa, id_coordinacion, comentario1, comentario2
    ) VALUES (
        p_id_comentario, p_tipo, p_id_docente, p_id_programa, p_id_coordinacion, p_comentario1, p_comentario2
    );
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `listar_actas_compromiso` ()   BEGIN
    SELECT 
        a.id,
        a.numero_acta,
        a.fecha_generacion,
        a.promedio_total,
        a.curso,
        u.nombre AS nombre_docente,
        u.correo,
        u.tipo_usuario
    FROM acta_compromiso a
    JOIN Docente d ON d.id_docente = a.id_docente
    JOIN Usuarios u ON u.id_usuario = d.id_usuario
    ORDER BY a.fecha_generacion DESC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `marcar_acta_como_enviada` (IN `acta_id` INT)   BEGIN
    UPDATE acta_compromiso
    SET enviado = TRUE
    WHERE id = acta_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `notas_clasificadas` ()   BEGIN
    SELECT nombre, promedio_total,
        CASE 
            WHEN promedio_total  BETWEEN 4.5 AND 5.0 THEN 'Excelente'
            WHEN promedio_total  BETWEEN 4.0 AND 4.4 THEN 'Bueno'
            WHEN promedio_total  BETWEEN 3.5 AND 3.9 THEN 'Aceptable'
            WHEN promedio_total  BETWEEN 3.0 AND 3.4 THEN 'Regular'
            WHEN promedio_total < 3.0 THEN 'Deficiente'
            ELSE 'Sin clasificación'
        END
    FROM evaluaciones,cursos;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ObtenerAlertasCalificacionesCriticas` ()   BEGIN
    SELECT 
        f.nombre AS nombre_facultad,
        d.id_docente,
        u.nombre AS nombre_docente,
        c.nombre AS nombre_curso,
        p.promedio_notas_curso
    FROM Promedio_Evaluacion_Docente_Por_Curso p
    INNER JOIN Cursos c ON p.id_curso = c.id_curso
    INNER JOIN Docente d ON p.id_docente = d.id_docente
    INNER JOIN Usuarios u ON d.id_usuario = u.id_usuario
    INNER JOIN Programas pr ON c.id_programa = pr.id_programa
    INNER JOIN Facultad f ON pr.id_facultad = f.id_facultad
    WHERE p.promedio_notas_curso <= 3.0
    ORDER BY f.nombre, p.promedio_notas_curso ASC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ObtenerComentariosPorDocente` (IN `p_id_docente` INT)   BEGIN
    SELECT
        id_comentario,
        tipo,
        id_programa,
        id_coordinacion,
        comentario1,
        comentario2
    FROM comentarios
    WHERE id_docente = p_id_docente;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ObtenerCursosPorCorreo` (IN `p_correo` VARCHAR(255))   BEGIN
    SELECT 
        c.nombre AS nombre_curso,
        p.promedio_ev_docente,
        p.promedio_notas_curso
    FROM 
        Usuarios u
    INNER JOIN Docente d ON u.id_usuario = d.id_usuario
    INNER JOIN Cursos c ON d.id_docente = c.id_docente
    INNER JOIN Promedio_Evaluacion_Docente_Por_Curso p ON c.id_curso = p.id_curso
    WHERE 
        u.correo = p_correo
        AND u.tipo_usuario = 'docente';
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ObtenerDocentesDestacados` ()   BEGIN
    SELECT 
        d.id_docente,
        u.nombre AS nombre_docente,
        f.nombre AS facultad,
        pr.nombre AS programa,
        c.nombre AS curso,
        e.promedio_ev_docente 
    FROM promedio_evaluacion_docente_por_curso e
    INNER JOIN Docente d ON e.id_docente = d.id_docente
    INNER JOIN Usuarios u ON d.id_usuario = u.id_usuario
    INNER JOIN Cursos c ON e.id_curso = c.id_curso
    INNER JOIN Programas pr ON c.id_programa = pr.id_programa
    INNER JOIN Facultad f ON pr.id_facultad = f.id_facultad
    WHERE e.promedio_ev_docente >= 4.0
    ORDER BY e.promedio_ev_docente DESC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ObtenerEvaluacionesPorCorreo` (IN `correo_usuario` VARCHAR(255))   BEGIN
    SELECT 
        e.id_evaluacion,
        e.id_docente,
        e.autoevaluacion,
        e.evaluacion_decano,
        e.evaluacion_estudiantes,
        e.promedio_total
    FROM Evaluaciones e
    INNER JOIN Docente d ON e.id_docente = d.id_docente
    INNER JOIN Usuarios u ON d.id_usuario = u.id_usuario
    WHERE u.correo = correo_usuario;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ObtenerIdCoordinacionPorNombre` (IN `nombre_coordinacion` VARCHAR(100))   BEGIN
    SELECT id_coordinacion
    FROM coordinacion
    WHERE nombre = nombre_coordinacion;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ObtenerIdCursoPorNombre` (IN `nombre_curso` VARCHAR(255))   BEGIN
    SELECT id_curso
    FROM Cursos
    WHERE nombre = nombre_curso
    LIMIT 1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ObtenerIdDocentePorNombre` (IN `nombre_usuario` VARCHAR(255))   BEGIN
    SELECT d.id_docente
    FROM Docente d
    INNER JOIN Usuarios u ON d.id_usuario = u.id_usuario
    WHERE u.nombre = nombre_usuario
    LIMIT 1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ObtenerIdFacultadPorNombre` (IN `nombre_facultad` VARCHAR(50))   BEGIN
    SELECT id_facultad
    FROM facultad
    WHERE nombre=nombre_facultad
    LIMIT 1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ObtenerIdProgramaPorNombre` (IN `nombre_programa` VARCHAR(100))   BEGIN
    SELECT id_programa
    FROM programas
    WHERE nombre = nombre_programa;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ObtenerIdUsuarioPorNombre` (IN `nombre_usuario` VARCHAR(255))   BEGIN
    SELECT id_usuario 
    FROM Usuarios 
    WHERE nombre = nombre_usuario 
    LIMIT 1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ObtenerPromedioNotasPorFacultad` ()   BEGIN
    SELECT 
        f.nombre AS facultad,
        ROUND(AVG(e.promedio_total), 2) AS promedio_facultad
    FROM Evaluaciones e
    JOIN Docente d ON e.id_docente = d.id_docente
    JOIN Programas p ON p.id_docente = d.id_docente
    JOIN Facultad f ON f.id_facultad = p.id_facultad
    GROUP BY f.nombre;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ObtenerPromedioNotasPorFacultad1` ()   SELECT 
    pedc.id_curso,
    c.id_programa,
    p.id_facultad,
    f.nombre AS nombre_facultad,
    pedc.promedio_notas_curso
FROM Promedio_Evaluacion_Docente_Por_Curso pedc
LEFT JOIN Cursos c ON c.id_curso = pedc.id_curso
LEFT JOIN Programas p ON p.id_programa = c.id_programa
LEFT JOIN Facultad f ON f.id_facultad = p.id_facultad
WHERE p.id_facultad IS NULL$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ObtenerPromedioNotasPorFacultad2` ()   BEGIN
    SELECT 
        f.nombre AS facultad,
        ROUND(AVG(pedc.promedio_notas_curso), 2) AS promedio_facultad
    FROM Promedio_Evaluacion_Docente_Por_Curso pedc
    JOIN Cursos c ON c.id_curso = pedc.id_curso
    JOIN Programas p ON p.id_programa = c.id_programa
    JOIN Facultad f ON f.id_facultad = p.id_facultad
    GROUP BY f.nombre;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ObtenerPromedioPorFacultad` ()   BEGIN
    SELECT 
        f.nombre AS facultad,
        ROUND(AVG(p.promedio_ev_docente),2) AS promedio_calificacion
    FROM Promedio_Evaluacion_Docente_Por_Curso p
    INNER JOIN Cursos c ON p.id_curso = c.id_curso
    INNER JOIN Programas pr ON c.id_programa = pr.id_programa
    INNER JOIN Facultad f ON pr.id_facultad = f.id_facultad
    GROUP BY f.nombre
    ORDER BY promedio_calificacion DESC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ObtenerTodosLosDocentes` ()   BEGIN
    SELECT 
        d.id_docente AS id_docente,
        u.nombre AS nombre_docente,
        u.apellido AS apellido_docente,
        u.identificacion AS identificacion_docente,
        p.nombre AS curso,
        e.promedio_total AS promedio_total
    FROM 
        Usuarios u
    LEFT JOIN 
        Docente d ON u.id_usuario = d.id_usuario
    LEFT JOIN 
        Programas p ON d.id_docente = p.id_docente
    LEFT JOIN 
        Evaluaciones e ON d.id_docente = e.id_docente AND p.id_programa = e.id_programa
    WHERE 
        u.id_rol = 2 OR d.id_docente IS NOT NULL;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ObtenerTodosLosUsuarios` ()   BEGIN
    SELECT 
        id_usuario,
        id_rol,
        activo,
        nombre,
        apellido,
        correo,
        identificacion,
        tipo_usuario,
        fecha_creacion,
        fecha_actualizacion
    FROM Usuarios;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ObtenerUsuarioPorCorreo` (IN `correo_usuario` VARCHAR(255))   BEGIN
    SELECT * 
    FROM usuarios
    WHERE correo = correo_usuario
    LIMIT 1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `obtener_acta_por_id` (IN `p_id` INT)   BEGIN
    SELECT * FROM acta_compromiso WHERE id = p_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Obtener_Docentes_Bajo_Promedio` ()   BEGIN
    SELECT 
        u.nombre AS nombre_completo,
        u.identificacion,
        p.nombre AS nombre_programa,
        e.promedio_total
    FROM 
        Usuarios u
    INNER JOIN Docente d ON u.id_usuario = d.id_usuario
    INNER JOIN Evaluaciones e ON d.id_docente = e.id_docente
    INNER JOIN Programas p ON p.id_docente = d.id_docente
    WHERE 
        e.promedio_total < 4.0;
        
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `promedio_global` ()   BEGIN
    SELECT ROUND(AVG(promedio_total), 2) AS promedio_global
    FROM Evaluaciones;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `promedio_por_curso` ()   BEGIN
    SELECT 
        c.id_curso,
        ROUND(AVG(e.promedio_total), 2) AS promedio_curso
    FROM 
        cursos c  -- Asumí que tienes una tabla de "cursos", cámbiala si es otro nombre
    JOIN 
        evaluaciones e ON c.id_curso = e.id_curso
    GROUP BY 
        c.id_curso;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SetActaCompromisoEnviada` (IN `actaId` INT)   BEGIN
    UPDATE acta_compromiso SET enviado = TRUE WHERE id = actaId;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `totalNoEvaluados` ()   BEGIN
    SELECT COUNT(*) AS total_no_evaluados
    FROM docentes_no_autoevaluados;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `total_docentes` ()   BEGIN
    SELECT COUNT(*) AS total_docentes FROM Docente;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `total_estudiantes_no_evaluaron` ()   BEGIN
    SELECT COUNT(*) As total_estudiantes_no_evaluaron
    FROM estudiantes_no_evaluaron;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateActaCompromiso` (IN `p_id` INT, IN `p_retroalimentacion` TEXT, IN `p_fecha_generacion` DATE)   BEGIN
    UPDATE acta_compromiso
    SET 
        retroalimentacion = p_retroalimentacion,
        fecha_generacion = p_fecha_generacion
    WHERE id = p_id;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acta_compromiso`
--

CREATE TABLE `acta_compromiso` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `numero_acta` varchar(255) NOT NULL,
  `fecha_generacion` date NOT NULL,
  `nombre_docente` varchar(255) NOT NULL,
  `apellido_docente` varchar(255) NOT NULL,
  `identificacion_docente` varchar(20) NOT NULL,
  `curso` varchar(255) NOT NULL,
  `promedio_total` decimal(3,2) NOT NULL,
  `retroalimentacion` text NOT NULL,
  `firma` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `acta_compromiso`
--

INSERT INTO `acta_compromiso` (`id`, `numero_acta`, `fecha_generacion`, `nombre_docente`, `apellido_docente`, `identificacion_docente`, `curso`, `promedio_total`, `retroalimentacion`, `firma`, `created_at`, `updated_at`) VALUES
(7, 'ACTA-4911fc6c-36e3-11f0-aae6-48e7dabfd0bc', '0000-00-00', 'ed', 'cdds', '10003', '1', 3.00, 'wjjdjdejw', NULL, '2025-05-22 08:03:41', '2025-05-22 08:03:41'),
(8, 'ACTA-c5f792c9-36e3-11f0-aae6-48e7dabfd0bc', '2025-05-22', 'Alejo', 'xcv', '1000009', 'DERECHO', 4.00, 'Aquí el decano hará sus comentarios hacia el respectivo docente', NULL, '2025-05-22 08:07:10', '2025-05-22 08:07:10'),
(9, 'ACTA-ed960da6-36e3-11f0-aae6-48e7dabfd0bc', '2025-05-22', 'Alejo', 'xcv', '1000009', 'DERECHO', 4.00, 'Aquí el decano hará sus comentarios hacia el respectivo docente', NULL, '2025-05-22 08:08:17', '2025-05-22 08:08:17'),
(10, 'ACTA-0574ce59-36ec-11f0-aae6-48e7dabfd0bc', '2025-05-22', 'Alejo', 'xcv', '1000009trr', 'DERECHO', 4.00, 'Aquí el decano hará sus comentarios hacia el respectivo docente', NULL, '2025-05-22 09:06:13', '2025-05-22 09:06:13'),
(11, 'ACTA-0682d9c7-36ed-11f0-aae6-48e7dabfd0bc', '2025-05-22', 'Carlos ruiz', 'sdfs', '10000008', 'INGENIERIA AMBIENTAL', 4.00, 'Aquí el decano hará sus comentarios hacia el respectivo docent', NULL, '2025-05-22 09:13:24', '2025-05-22 09:13:24'),
(12, 'ACTA-631b88ab-3780-11f0-aae6-48e7dabfd0bc', '2025-05-23', 'Alejo', 'xcv', '1000000\'', 'DERECHO', 4.00, 'Aquí el decano hará sus comentarios hacia el respectivo docent', NULL, '2025-05-23 02:47:53', '2025-05-23 02:47:53'),
(13, 'ACTA-cb9a5f7e-3783-11f0-aae6-48e7dabfd0bc', '2025-05-23', 'Alejo', 'xcv', '10020200', 'DERECHO', 4.00, 'Aquí el decano hará sus comentarios hacia el respectivo docente', NULL, '2025-05-23 03:12:17', '2025-05-23 03:12:17'),
(14, 'ACTA-521ee4dd-3786-11f0-aae6-48e7dabfd0bc', '2025-05-23', 'Alejo', 'xcv', '10020200', 'DERECHO', 4.00, 'no hace nada siempre', NULL, '2025-05-23 03:30:22', '2025-05-23 03:30:22'),
(15, 'ACTA-9cddd375-3786-11f0-aae6-48e7dabfd0bc', '2025-05-23', 'Alejo', 'xcv', '10020200', 'DERECHO', 4.00, 'Aquí el decano hará sus comentarios hacia el respectivo docente no hace nada', NULL, '2025-05-23 03:32:27', '2025-05-23 03:32:27'),
(16, 'ACTA-b14fa7ff-3789-11f0-aae6-48e7dabfd0bc', '2025-05-23', 'Alejo', 'xcv', '10020200', 'DERECHO', 4.00, 'Aquí el decano hará sus comentarios hacia el respectivo docente no hace nada', NULL, '2025-05-23 03:54:30', '2025-05-23 03:54:30'),
(17, 'ACTA-bd18d998-3789-11f0-aae6-48e7dabfd0bc', '2025-05-23', 'Alejo', 'xcv', '100202006787', 'DERECHO', 4.00, 'Aquí el decano hará sus comentarios hacia el respectivo docente no hace nada', NULL, '2025-05-23 03:54:50', '2025-05-23 03:54:50'),
(18, 'ACTA-d12f6d1b-3789-11f0-aae6-48e7dabfd0bc', '2025-05-23', 'Alejo', 'xcv', '100000988', 'DERECHO', 4.00, 'Aquí el decano hará sus comentarios hacia el respectivo docent', NULL, '2025-05-23 03:55:23', '2025-05-23 03:55:23'),
(19, 'ACTA-3ac29260-378c-11f0-aae6-48e7dabfd0bc', '2025-05-23', 'Ana Gómez', 'dfg', '08899898', 'INGENIERIA SOFTWARE', 3.00, 'Aquí el decano hará sus comentarios hacia el respectivo docente', NULL, '2025-05-23 04:12:40', '2025-05-23 04:12:40'),
(20, 'ACTA-a7f2ee7c-37d7-11f0-aae6-48e7dabfd0bc', '2025-05-23', 'Alejo', 'xcv', '088998989000', 'DERECHO', 4.00, 'Aquí el decano hará sus comentarios hacia el respectivo docent', NULL, '2025-05-23 13:12:27', '2025-05-23 13:12:27'),
(21, 'ACTA-4e44d26e-37e8-11f0-aae6-48e7dabfd0bc', '2025-05-23', 'Ana Gómez', 'dfg', '08899898900055', 'INGENIERIA SOFTWARE', 4.00, 'Aquí el decano hará sus comentarios hacia el respectivo docent', NULL, '2025-05-23 15:11:37', '2025-05-23 15:11:37'),
(22, 'ACTA-2d1d3329-37e9-11f0-aae6-48e7dabfd0bc', '2025-05-23', 'Carlos ruiz', 'sdfs', '123456798', 'INGENIERIA AMBIENTAL', 4.00, 'Aquí el decano hará sus comentarios hacia el respectivo docent', NULL, '2025-05-23 15:17:51', '2025-05-23 15:17:51');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alertas_bajo_desempeno`
--

CREATE TABLE `alertas_bajo_desempeno` (
  `id_alerta` int(11) NOT NULL,
  `id_facultad` int(11) DEFAULT NULL,
  `id_promedio` int(11) DEFAULT NULL,
  `id_docente` int(11) DEFAULT NULL,
  `id_curso` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `id_comentario` int(11) NOT NULL,
  `tipo` varchar(50) DEFAULT NULL,
  `id_docente` int(11) DEFAULT NULL,
  `id_programa` int(11) DEFAULT NULL,
  `id_coordinacion` int(11) DEFAULT NULL,
  `comentario1` text DEFAULT NULL,
  `comentario2` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`id_comentario`, `tipo`, `id_docente`, `id_programa`, `id_coordinacion`, `comentario1`, `comentario2`) VALUES
(544, 'COMENTARIOS COORDINADOR', 43, 63, 3, 'el docente tiene buena disposición para cumplir con sus cursos ', 'debe mejorar en ser mas activo y prpositivo en actividades de l programa y de la facultad'),
(545, 'COMENTARIOS COORDINADOR', 44, 63, 3, 'tiene acttitud y compromiso .', 'ser mas visible, proponer en los comites, de seguro tiene mucho potencial para generar estrategias en su prorama '),
(546, 'COMENTARIOS COORDINADOR', 45, 63, 3, 'su alergria, su compromiso , su cumplimiento y su sentido de pertenecia, además de motivar a los estudiantes de una gran manera ', NULL),
(547, 'COMENTARIOS COORDINADOR', 46, 63, 3, 'es un docente muy motivador, comprometido, con iniciativa y disposición ', NULL),
(548, 'COMENTARIOS COORDINADOR', 47, 63, 3, 'es un muy buen docente desde lo técnico ', 'le falta cumplir y mejorar su disposicio para apoyar actividades que se propone en la facultad'),
(549, 'COMENTARIOS COORDINADOR', 48, 63, 3, 'Es un docente muy bueno desde lo técnico y de conocimientos, tiene muy buena actitud, disposició y compromiso ', NULL),
(550, 'COMENTARIOS DOCENTES', 49, 63, 3, 'Dedicación a la preparación y ejecución del curso', 'Determinar objetivos más alcanzables en el curso '),
(551, 'COMENTARIOS DOCENTES', 43, 63, 3, 'Generar espacios de aprendizaje transversal a la carrera ', 'Definir objetivos alcanzables de acuerdo a la características del curso'),
(552, 'COMENTARIOS ESTUDIANTES', 44, 63, 3, '.', NULL),
(553, 'COMENTARIOS ESTUDIANTES', 45, 63, 3, 'en su manera de dar a conocer sus temas de forma dinamia y practica ', 'no debe mejorar en el sentido que lo temas explicados quedan claros '),
(554, 'COMENTARIOS ESTUDIANTES', 46, 63, 3, 'Es un docente excelente, nos asesoraba muy bien en los temas que no entendíamos en el curso', NULL),
(555, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Si calidad de enseñanza ', 'Ninguna observación '),
(556, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Su calidad de enseñanza ', 'Ninguna observación '),
(557, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Se destaca en explicar de manera sencilla ', 'Hacer mas ejercicios y que sea mas interactivo '),
(558, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Flexible en trabajo en clase ', 'Forma de calificar ( no valida el proceso, solo los resultados), clases confusas y evaluaciones complicadas '),
(559, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'muy buen profesor ', 'nada por mejorar '),
(560, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Llegar siempre tarde a las clases', 'Llega muy tarde a las clases, casi no está pendiente de los estudiantes si tienen alguna duda '),
(561, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, '.', '.'),
(562, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, '.', '.'),
(563, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Bueno ', 'Enseñar '),
(564, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Excelente ', NULL),
(565, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Busca la investigación y trabajo en equipo', NULL),
(566, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Dar buenas explicaciones y ser flexible ', 'No aplica '),
(567, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, NULL, 'brindar mas actividades para comprender mejor los temas vistos en clase '),
(568, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'todos los temas', 'sus clases van muy rápido '),
(569, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Su clase es muy entendible ', NULL),
(570, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Explicar los temas', 'Nada'),
(571, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Su dedicación e interes por el aprendizaje de sus estudiantes', 'Desde mi punto de vista, el docente cumplió con el plan de aula '),
(572, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Su respeto y comprensión con los estudiante. Es comodo y entendible los ejercicios con el maestro. Me siento agradecida y cómoda de haber pasado el semestre. ', 'Con respeto, pienso que debería mejorar en tener mejor organización al escribir los ejercicios. Tal vez se vuelve algo confuso, pero no importa, se agradece el esfuerzo y lo que nos explica. '),
(573, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'explicar los temas', 'nada'),
(574, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Todo', 'Nada'),
(575, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Muy buena metodología, recalca en los temas y se hace entender ', NULL),
(576, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'El docente siempre llega puntual, expresa con claridad los temas, los talleres y exámenes siempre son acordes a los temas vistos en clase. Un muy buen profesor. Felicitaciones.', NULL),
(577, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'realizacion de talleres practicos para mejorar el estudio y comprension de nuevos temas vistos y asi mismo evalua las practicas del taller por medio de parciales llevando a cabo un buen plan de estudio ', 'nada por ahora sigue asi '),
(578, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'El docente se destaca en su paciencia para enseñar los temas vistos', 'el docente debe ser mas consciente y de que no podemos aprender todo en un día  '),
(579, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'bien', 'esta bien que deje taller,pero que no sea tan largo y todavia finalizando semestre '),
(580, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Da buen entendimiento en las clases y resuelve dudas de manera muy clara ', 'Ninguno'),
(581, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, NULL, 'Congruencia con temas vistos en clase y evaluaciones (talleres),  poca flexibilidad al resolver dudas.'),
(582, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Hace que los temas se entiendan facil', 'Debe mejorar en que no sea tan neutra la clase.'),
(583, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'En diferentes aspectos sobre integrales', 'No se llevamos un semestre con el'),
(584, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Exelente calidad de enseñanza ', 'Ninguna observación '),
(585, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Economia', NULL),
(586, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'todo', 'todo'),
(587, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Explica bien', '.'),
(588, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Bueno', 'Explica excelente pero quedamos un poco atrasados ya que íbamos atrasados con el otro profe y por eso ahora estoy perdida '),
(589, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Da el tema en manera clara ', 'El orden '),
(590, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'su actitud ', 'nada '),
(591, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'explicar temas paso a paso ayudándonos a nosotros como estudiantes a entender mejor', 'en ser mas dinámico '),
(592, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'El docente se destaca en la puntualidad ', 'El docente debe mejorar en la metodología de explicar, el como puede hacer que los estudiantes puedan comprender los temas, y que en especial el taller para estudiar tenga que ver con el examen, y q si se le pregunta una duda sin mucha relevancia para decir que esta resolviendo el examen el mismo que porfavor pueda responder con amabilidad o por lo menos de una idea para aclarar la duda teniendo en cuenta que no hubo las horas de clases establecidas  así que no se justifica decir que ya lo \"sabiamos\"'),
(593, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Buen aprendizaje', 'No colocar parciales duros y trabajos largos'),
(594, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Dar buenas explicaciones ', 'Ser justo en los parciales en el ámbito de colocar ejercicios acorde a lo estudiado y puesto en los talleres '),
(595, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Todo', 'Nada'),
(596, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Regular ', NULL),
(597, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Nada', 'Nuevos docentes como Manuel Obando que les guste su profesión y brinden sus conocimientos, no como Diego y Victor hugo'),
(598, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Su carisma', 'La manera de explicar alguna inquietud sobre algún tema, tener un poco más de empatía y querer ayudar de verdad a despejar la duda'),
(599, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'La puntualidad', 'Retroalimentación de resultados.'),
(600, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Cumplido ', 'Nada '),
(601, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, NULL, 'Ser más claro con sus explicaciones '),
(602, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Bien', 'Metodología de estudio'),
(603, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Su personalidad y disposición al enseñar ', 'Un poco en la metodología pero de resto es muy bien docente '),
(604, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Bueno', 'Bueno'),
(605, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Álgebra ', NULL),
(606, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Matemáticas ', 'Está todo bien '),
(607, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Ser dinámico ', 'Dar más formas de calificar '),
(608, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Bien', 'Bien'),
(609, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'La profe maneja una metodología muy acertada para el aprendizaje ', NULL),
(610, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Su manera de explicar y su paciencia', '...'),
(611, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Bien', 'Bien'),
(612, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, '.', '.'),
(613, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Excelente profesor', 'Nada'),
(614, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Bien', 'Buen'),
(615, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Buen profesor ', 'No tiene que mejorar en nada '),
(616, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Enseñanza ', 'Que lo dejen para el próximo semestre por favor y de la continuación de circuitos 2'),
(617, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, '.', '.'),
(618, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'enseña muy  bien es muy pacienye', 'nada'),
(619, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'ESTA BIEN ASI', 'ESTA BIEN ASI'),
(620, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Buen Aprendizaje ', NULL),
(621, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Muy buen profesor', 'Nada'),
(622, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, '.', '.'),
(623, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, '.', '.'),
(624, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'na', 'na'),
(625, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, '..', NULL),
(626, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Explica muy bien', 'En nada '),
(627, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Bueno para enseñar ', 'Nada '),
(628, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, '..', 'sus explicaiones'),
(629, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'conocimiento en su area', '.'),
(630, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Todo', 'Nada'),
(631, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Buen profe ', 'Todo bien '),
(632, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Buena metodología ', 'Acompañamiento '),
(633, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, '.', '.'),
(634, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, '.', '.'),
(635, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'ninguno ', 'ninguno '),
(636, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Una temática muy buena ', NULL),
(637, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Puntualidad ', 'Que explique bien sus temas '),
(638, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Es muy puntual en su horario y es claro en las metodología que utiliza ', NULL),
(639, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Es muy puntual en su horario de clases y aprovecha muy bien el tiempo en la clases para abarcar todos los temas ', 'No'),
(640, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Muy puntual y correcto con las clases ', 'Pocas cosas en las que debe mejorar como profesor,'),
(641, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Explica de forma eficiente.  Su interés es que todos entiendan.', NULL),
(642, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'se esfuerza porque el estudiante aprenda el tema ', 'nada a mi parecer'),
(643, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'se esfuerza por que el estudiante le quede claro el tema', 'a mi parecer, nada'),
(644, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, NULL, 'No dar tantos temas en una sola clase ir más despacio '),
(645, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Un execelente docente, explica todos sus temas de una forma detallada y precisa todo el curso fue excelente y un buen profesor ', NULL),
(646, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'en una mierda, el peor profesor de la u sin duda ', 'Literal en todo '),
(647, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Enseñar temas de aprendizaje, enfocados en la carrera.', 'En el momento, no tengo un argumento claro para responder a la pregunta.'),
(648, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Excelente docente, maneja y explica cada tema a la perfección ', NULL),
(649, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'N/A', 'N/A'),
(650, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, ' Tiene una explicación clara y concisa  acerca de todos los temas', 'La verdad me gusta la metodología que maneja, no haría ningún  cambio '),
(651, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'forma de explicar', 'nada'),
(652, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'explica bien ', 'nada'),
(653, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'en tomar en cuenta las asesorias de los estudiantes y ver su desempeño a lo largo del curso', 'dar mas oportunidades en cuanto a trabajos y demás'),
(654, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Presentar los temas de manera clara y precisa, también en dar una clase que motiva al estudiante a aprender y preguntar si no entiende algún tema, por último siempre busca la forma de hacer las clase más dinámicas.', 'El docente a lo largo del semestre no presento ningún aspecto para mejorar, en mi punto de vista el docente cumplio todas las expectativas acerca del curso.'),
(655, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'No se ', 'No se'),
(656, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Presentar los temas de manera clara y precisa, también en dar una clase que motiva al estudiante a aprender y preguntar si no entiende algún tema, por último siempre busca la forma de hacer las clase más dinámicas.', 'El docente a lo largo del semestre no presento ningún aspecto para mejorar, en mi punto de vista el docente cumplio todas las expectativas acerca del curso.'),
(657, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Puntualidad, comprensión ', 'Metodología al momento de enseñar'),
(658, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Explicar bien y se entienden sus temas con su forma de enseñar ', NULL),
(659, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Buen profe', 'Buen profe '),
(660, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Explicar y darse a entender bien en sus clases ', NULL),
(661, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Todo', 'Nada'),
(662, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Va rápido en los temas pero explica súper bn, entiendo todo', NULL),
(663, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Bueno ', 'Nada '),
(664, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Son muy buenas sus clases y su metodología ', NULL),
(665, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Muy responsable con su deber como profesor ', 'Pocas cosas que mejorar como profesor '),
(666, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Destaca por su puntualidad, conpromiso con el curso, y conocimientos', 'Nada'),
(667, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Excelente', 'Nada'),
(668, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, '.', '.'),
(669, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Su forma de dar clases', 'Nada'),
(670, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Calidad de vida enseñanza', 'Cantidad de ejercicios de taller (pocos en el tercer corte)'),
(671, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Clases buenas', 'Explicar menos rapido '),
(672, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Explicar muy bien.', 'Nada es perfecto '),
(673, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Explicar bien ', 'Nada es perfecto '),
(674, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Dicta bien sus clases ', 'Nada, es buen docente '),
(675, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Bueno', 'Bueno'),
(676, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'la puntualidad y en dar su plan de aula completo', 'En lo que el explica en clase y en talleres, salen algunos puntos en el parcial que no hemos visto '),
(677, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Bien', 'Bien'),
(678, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Bien', 'Bien'),
(679, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, '.', '.'),
(680, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Su manera de explicar, paciencia y acompañamiento', '...'),
(681, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Su paciencia y manera de explicar', NULL),
(682, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, '.', '.'),
(683, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Su dedicación e interes por el aprendizaje de sus estudiantes', 'Desde mi punto de vista, el docente cumplió con el plan de aula'),
(684, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Explicar muy bien cada clase.', NULL),
(685, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, '.', '.'),
(686, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Ser buen profesor ', 'Los trabajos que deja para entregar no son claro '),
(687, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, '.', '.'),
(688, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Todo está bien', 'nada'),
(689, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, '.', '.'),
(690, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, '.', '.'),
(691, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Enseña muy bien ', 'No debe mejorar en nada '),
(692, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Explica bien ', 'No debe mejorar en nada '),
(693, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, '.', '.'),
(694, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, '.', '.'),
(695, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'excelente profesor', NULL),
(696, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Algunos aspectos', 'No explica bien'),
(697, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Puntualidad', 'Debería dejar de tratar a los estudiantes como “tontos”'),
(698, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, NULL, 'La llegada a clase, llega 10-15 minutos después de la hora establecida '),
(699, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, '.', NULL),
(700, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'explicación de temas', 'usar mas las ayudas tecnologicas'),
(701, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'muy buen profesor', 'nada por mejorar '),
(702, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'En ser miy paciente y explicarnos los temas de una forma clara ', NULL),
(703, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Paciencia ', 'Nada '),
(704, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'N/A', 'N/A'),
(705, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'explica los temas con claridad', 'nada '),
(706, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'No acepta diferentes formas de calificar fue de los parciales ', NULL),
(707, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Se destaca en la forma en que explica.', 'Debe mejorar en hacer mas ejercicios para que se pueda entender mejor.'),
(708, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'La forma de dar la clase ', 'Nada'),
(709, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Muy buen profesor, paciente y diligente ', NULL),
(710, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Puntualidad a la hora de iniciar las clases ', 'Poner mas actividades calificativas '),
(711, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Su conocimiento sobre el tema', '...'),
(712, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'muy buen profesor y gran ser humano', 'nada'),
(713, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, '.', '.'),
(714, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Bien', 'Metodologia'),
(715, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'explica muy bien los temas vistos en cada tema ', 'que sean mas dinámicas '),
(716, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Explicar super bien ', NULL),
(717, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, '.', '.'),
(718, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Excelente', 'Nada'),
(719, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Calidad de enseñanza ', 'Ejercicios algo confusos'),
(720, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Excelente ', NULL),
(721, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Buena persona, buen profesor y es justo en el tema académico ', 'No aplica '),
(722, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Fomenta la investigación ', NULL),
(723, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Bueno', 'Bueno'),
(724, 'COMENTARIOS ESTUDIANTES', NULL, 63, NULL, 'Fisica', 'Estrategia ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `coordinacion`
--

CREATE TABLE `coordinacion` (
  `id_coordinacion` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `coordinacion`
--

INSERT INTO `coordinacion` (`id_coordinacion`, `nombre`) VALUES
(1, 'Ingeniería'),
(2, 'Derecho'),
(3, 'Administración'),
(4, 'Contaduría'),
(5, 'deporte');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `id_curso` int(11) NOT NULL,
  `codigo` varchar(50) DEFAULT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `id_programa` int(11) DEFAULT NULL,
  `id_docente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`id_curso`, `codigo`, `nombre`, `id_programa`, `id_docente`) VALUES
(226, '11180320DA', 'LABORATORIO INSTRUMENTACIÓN BASICA', 63, 43),
(227, '11180426DA', 'CIRCUITOS DIGITALES I', 63, 44),
(228, '11180529DA', 'CAD', 63, 45),
(229, '11180533DA', 'CIRCUITOS DIGITALES II', 63, 46),
(230, '11180641DA', 'LABORATORIO DE ELECTRONICA II', 63, 47),
(231, '11180748DA', 'ELECTIVA I: OPTATIVA', 63, 48),
(232, '11180749DA', 'INSTRUMENTACION INDUSTRIAL', 63, 49),
(233, '32221208DA', 'CIRCUITOS ELECTRICOS II Y LABORATORIO', 63, 49),
(234, '11180639DA', 'SISTEMA DE CONTROL I', 63, NULL),
(235, '11180959DA', 'SOFTWARE PARA  APLICACIONES INDUSTRIALES', 63, NULL),
(236, '11181065DA', 'CONTROL DE PROCESOS', 63, NULL),
(237, '18220146DA', 'MATEMATICA BASICA', 63, NULL),
(238, '11180534DA', 'LABORATORIO DE ELECTRONICA I', 63, NULL),
(239, '12190308DA', 'CALCULO II', 63, NULL),
(240, '13200101DA', 'MATEMÁTICA I', 63, NULL),
(241, '32221207DA', 'ALGEBRA LINEAL', 63, NULL),
(242, '33220312DA', 'CALCULO II (INTEGRAL', 63, NULL),
(243, '11180854DA', 'OPTOELECTRONICA', 63, NULL),
(244, '11181064DA', 'ROBOTICA II', 63, NULL),
(245, '11180213DA', 'CIRCUITOS ELECTRICOS II', 63, NULL),
(246, '11180745DA', 'SISTEMA DE CONTROL II', 63, NULL),
(247, '11180852DA', 'ELECTIVA II: OPTATIVA', 63, NULL),
(248, '11180855DA', 'PLCs', 63, NULL),
(249, '11180958DA', 'SCADA', 63, NULL),
(250, '19203328DB', 'TALLER DE INVESTIGACIÓN', 63, NULL),
(251, '12190204DA', 'CALCULO I', 63, NULL),
(252, '12190205DA', 'ALGEBRA LINEAL', 63, NULL),
(253, '18220206DA', 'ALGEBRA LINEAL', 63, NULL),
(254, '36220205DA', 'CALCULO I (DIFERENCIAL)', 63, NULL),
(255, '11180319DA', 'CIRCUITOS ELECTRONICOS', 63, NULL),
(256, '11180638DA', 'CIRCUITOS DIGITALES III', 63, NULL),
(257, '11180642DA', 'CIRCUITOS DE POTENCIA', 63, NULL),
(258, '11180744DA', 'CIRCUITOS DIGITALES IV', 63, NULL),
(259, '11180856DA', 'ELECTIVA III ESPECIALIZADA', 63, NULL),
(260, '11180957DA', 'ROBOTICA', 63, NULL),
(261, '11180960DA', 'ELEACTIVA IV ESPECIALIZADA', 63, NULL),
(262, '19242221NN', 'FUNADMENTOS Y METODOLOGÍA DE LA INVESTIG', 63, NULL),
(263, '11180211DA', 'FISICA I', 63, NULL),
(264, '11180427DA', 'CIRCUITOS ANALOGICOS', 63, NULL),
(265, '11180747DA', 'COMUNICACIONES PARA SISTEMAS ELECTRONICO', 63, NULL),
(266, '11180851DA', 'CONTROL INTELIGENTE', 63, NULL),
(267, '11181070DA', 'ELECTIVA VI ESPECIALIZADA', 63, NULL),
(268, '12190206DB', 'FISICA I', 63, NULL),
(269, '32221206DA', 'FISICA I', 63, NULL),
(270, '36220103DA', 'FISICA I', 63, NULL);

--
-- Disparadores `cursos`
--
DELIMITER $$
CREATE TRIGGER `trg_curso_before_delete` BEFORE DELETE ON `cursos` FOR EACH ROW BEGIN
    IF OLD.id_docente IS NOT NULL THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'No se puede eliminar el curso: tiene docente asignado.';
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trg_curso_before_insert` BEFORE INSERT ON `cursos` FOR EACH ROW BEGIN
    IF EXISTS (
        SELECT 1 FROM Cursos WHERE codigo = NEW.codigo
    ) THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Ya existe un curso con ese código.';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docente`
--

CREATE TABLE `docente` (
  `id_docente` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `cod_docente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `docente`
--

INSERT INTO `docente` (`id_docente`, `id_usuario`, `cod_docente`) VALUES
(43, 1, 128),
(44, 2, 567),
(45, 3, 986),
(46, 4, 456),
(47, 5, 456),
(48, 6, 123),
(49, 7, 453);

--
-- Disparadores `docente`
--
DELIMITER $$
CREATE TRIGGER `trg_docente_before_delete` BEFORE DELETE ON `docente` FOR EACH ROW BEGIN
    IF EXISTS (
        SELECT 1 FROM Cursos WHERE id_docente = OLD.id_docente
    ) THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'No se puede eliminar el docente: tiene cursos asignados.';
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trg_docente_before_insert` BEFORE INSERT ON `docente` FOR EACH ROW BEGIN
    IF EXISTS (
        SELECT 1 FROM Docente WHERE cod_docente = NEW.cod_docente
    ) THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'El docente ya está registrado.';
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trg_docente_before_update` BEFORE UPDATE ON `docente` FOR EACH ROW BEGIN
    IF NEW.id_docente != OLD.id_docente AND EXISTS (
        SELECT 1 FROM Evaluaciones WHERE id_docente = OLD.id_docente
    ) THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'No se puede cambiar el ID del docente con evaluaciones asociadas.';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docentes_no_autoevaluados`
--

CREATE TABLE `docentes_no_autoevaluados` (
  `id_docente_No_Evaluado` int(11) NOT NULL,
  `id_facultad` int(11) DEFAULT NULL,
  `id_coordinacion` int(11) DEFAULT NULL,
  `id_programa` int(11) DEFAULT NULL,
  `id_docente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `docentes_no_autoevaluados`
--

INSERT INTO `docentes_no_autoevaluados` (`id_docente_No_Evaluado`, `id_facultad`, `id_coordinacion`, `id_programa`, `id_docente`) VALUES
(2, 2, NULL, NULL, 43),
(3, 3, NULL, 68, 44),
(4, 4, NULL, NULL, 45),
(5, 2, NULL, NULL, 46),
(6, 5, NULL, NULL, 47),
(7, 2, 2, NULL, 48),
(8, 2, NULL, NULL, 49);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiantes_no_evaluaron`
--

CREATE TABLE `estudiantes_no_evaluaron` (
  `id_estudiante` int(11) NOT NULL,
  `id_facultad` int(11) DEFAULT NULL,
  `id_programa` int(11) DEFAULT NULL,
  `semestre` int(11) DEFAULT NULL,
  `cod_estudiante` int(11) DEFAULT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `codigo_curso` varchar(50) DEFAULT NULL,
  `nombre_curso` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estudiantes_no_evaluaron`
--

INSERT INTO `estudiantes_no_evaluaron` (`id_estudiante`, `id_facultad`, `id_programa`, `semestre`, `cod_estudiante`, `nombre`, `email`, `codigo_curso`, `nombre_curso`) VALUES
(13, 2, 63, 1, 3241, 'Jaime', 'adsf', '12343', 'FISICA II'),
(14, 3, 64, 2, 2134, 'luiz', 'asdfa', '3423', 'CIRCUITOS ELECTRONICOS'),
(15, 4, 65, 3, 23412, 'dfa', 'asdfa', '324234', 'LABORATORIO INSTRUMENTACIÓN BASICA'),
(16, 2, 66, 4, 2134, 'sadf', 'asdfa', '2342', 'FUNDAMENTOS DE INVESTIGACIÓN'),
(17, 5, 63, 5, 2134123, 'asdf', 'sdf', '23423', 'CALCULO I (DIFERENCIAL)'),
(18, 2, 68, 7, 213412, 'sdfa', 'asdfa', '234', 'CIRCUITOS ELECTRONICOS'),
(19, 2, 63, 1, 213413, 'sdfa', 'asdfa', '234', 'LABORATORIO INSTRUMENTACIÓN BASICA'),
(20, NULL, 63, 1, 822236, '', '', '3245.2857142857', 'CALCULO II'),
(21, NULL, 63, 1, 935228, '', '', '-9023.1428571429', 'CIRCUITOS ANALOGICOS'),
(22, NULL, 63, 1, 1048221, '', '', '-21291.571428571', 'LABORATORIO INTEGRADO DE FISICA'),
(23, NULL, 63, 1, 1161213, '', '', '-33560', 'CIRCUITOS DIGITALES II'),
(24, NULL, 63, 1, 1274205, '', '', '-45828.428571429', 'SISTEMA ESTOCÁSTICO'),
(25, NULL, 63, 1, 1387197, '', '', '-58096.857142857', 'SISTEMA DE CONTROL I'),
(26, NULL, 63, 1, 1500190, '', '', '-70365.285714286', 'ADMINISTRACIÓN'),
(27, NULL, 63, 1, 1613182, '', '', '-82633.714285714', 'METODOLOGIA DE LA INVESTIGACIÓN'),
(28, NULL, 63, 1, 1726174, '', '', '-94902.142857143', 'LABORATORIO DE ELECTRONICA II'),
(29, NULL, 63, 1, 1839166, '', '', '-107170.57142857', 'ELECTIVA I: OPTATIVA'),
(30, NULL, 63, 1, 1952159, '', '', '-119439', 'ELEACTIVA IV ESPECIALIZADA'),
(31, NULL, 63, 1, 2065151, '', '', '-131707.42857143', 'DERECHO LABORAL'),
(32, NULL, 63, 1, 2178143, '', '', '-143975.85714286', 'EDUCACIÓN Y LEGISLACIÓN AMBIENTAL'),
(33, NULL, 63, 1, 2291135, '', '', '-156244.28571429', 'TALLER DE INVESTIGACIÓN'),
(34, NULL, 63, 1, 2404128, '', '', '-168512.71428571', 'FISICA I'),
(35, NULL, 63, 1, 2517120, '', '', '-180781.14285714', 'INGLES I'),
(36, NULL, 63, 1, 2630112, '', '', '-193049.57142857', 'FILOSOFIA'),
(37, NULL, 63, 1, 2743104, '', '', '-205318', 'COMPETENCIAS CIUDADANAS'),
(38, NULL, 63, 1, 2856097, '', '', '-217586.42857143', 'CIRCUITOS ELÉCTRICOS I'),
(39, NULL, 63, 1, 2969089, '', '', '-229854.85714286', 'CALCULO I (DIFERENCIAL)'),
(40, NULL, 63, 1, 3082081, '', '', '-242123.28571429', 'INTRODUCCIÓN A LA PROGRAMACION'),
(41, NULL, 63, 1, 3195073, '', '', '-254391.71428571', 'CIRCUITOS ELECTRICOS II'),
(42, NULL, 63, 1, 3308066, '', '', '-266660.14285714', 'FISICA II'),
(43, NULL, 63, 1, 3421058, '', '', '-278928.57142857', 'CAD'),
(44, NULL, 63, 1, 3534050, '', '', '-291197', 'ELECTIVA I: OPTATIVA'),
(45, NULL, 63, 1, 3647042, '', '', '-303465.42857143', 'GESTIÓN TECNOLÓGICA Y FINANCIERA'),
(46, NULL, 63, 1, 3760035, '', '', '-315733.85714286', 'INGLES III'),
(47, NULL, 63, 1, 3873027, '', '', '-328002.28571429', 'CALCULO I (DIFERENCIAL)'),
(48, NULL, 63, 1, 3986019, '', '', '-340270.71428571', 'CALCULO III'),
(49, NULL, 63, 1, 4099011, '', '', '-352539.14285714', 'LABORATORIO INTEGRADO DE FISICA'),
(50, NULL, 63, 1, 4212004, '', '', '-364807.57142857', 'CIRCUITOS DIGITALES I'),
(51, NULL, 63, 1, 4324996, '', '', '-377076', 'CIRCUITOS ANALOGICOS'),
(52, NULL, 63, 1, 4437988, '', '', '-389344.42857143', 'CAD'),
(53, NULL, 63, 1, 4550980, '', '', '-401612.85714286', 'ADMINISTRACIÓN'),
(54, NULL, 63, 1, 4663973, '', '', '-413881.28571429', 'CALCULO II'),
(55, NULL, 63, 1, 4776965, '', '', '-426149.71428571', 'INGLES II'),
(56, NULL, 63, 1, 4889957, '', '', '-438418.14285714', 'TECNOLOGIA Y SOCIEDAD'),
(57, NULL, 63, 1, 5002949, '', '', '-450686.57142857', 'CALCULO II'),
(58, NULL, 63, 1, 5115942, '', '', '-462955', 'INGLES II'),
(59, NULL, 63, 1, 5228934, '', '', '-475223.42857143', 'FUNDAMENTOS DE INVESTIGACIÓN'),
(60, NULL, 63, 1, 5341926, '', '', '-487491.85714286', 'METODOLOGIA DE LA INVESTIGACIÓN'),
(61, NULL, 63, 1, 5454918, '', '', '-499760.28571429', 'FISICA I'),
(62, NULL, 63, 1, 5567911, '', '', '-512028.71428571', 'CALCULO I'),
(63, NULL, 63, 1, 5680903, '', '', '-524297.14285714', 'INGLES I'),
(64, NULL, 63, 1, 5793895, '', '', '-536565.57142857', 'CAD'),
(65, NULL, 63, 1, 5906887, '', '', '-548834', 'CIRCUITOS DIGITALES II'),
(66, NULL, 63, 1, 6019880, '', '', '-561102.42857143', 'LABORATORIO DE ELECTRONICA I'),
(67, NULL, 63, 1, 6132872, '', '', '-573370.85714286', 'CIRCUITOS ELECTRONICOS'),
(68, NULL, 63, 1, 6245864, '', '', '-585639.28571429', 'LABORATORIO INSTRUMENTACIÓN BASICA'),
(69, NULL, 63, 1, 6358856, '', '', '-597907.71428571', 'FISICA III'),
(70, NULL, 63, 1, 6471849, '', '', '-610176.14285714', 'ELECTIVA I: OPTATIVA'),
(71, NULL, 63, 1, 6584841, '', '', '-622444.57142857', 'ELECTIVA II: OPTATIVA'),
(72, NULL, 63, 1, 6697833, '', '', '-634713', 'METODOLOGIA DE LA INVESTIGACIÓN'),
(73, NULL, 63, 2, 6810825, '', '', '-646981.42857143', 'CONTROL INTELIGENTE'),
(74, NULL, 63, 2, 6923818, '', '', '-659249.85714286', 'ELECTIVA II: OPTATIVA'),
(75, NULL, 63, 2, 7036810, '', '', '-671518.28571429', 'GESTION FINANCIERA'),
(76, NULL, 63, 2, 7149802, '', '', '-683786.71428571', 'OPTOELECTRONICA'),
(77, NULL, 63, 2, 7262794, '', '', '-696055.14285714', 'PLCs'),
(78, NULL, 63, 2, 7375787, '', '', '-708323.57142857', 'ELECTIVA III ESPECIALIZADA'),
(79, NULL, 63, 2, 7488779, '', '', '-720592', 'EDUCACIÓN Y LEGISLACIÓN AMBIENTAL'),
(80, NULL, 63, 2, 7601771, '', '', '-732860.42857143', 'TALLER DE INVESTIGACIÓN'),
(81, NULL, 63, 2, 7714763, '', '', '-745128.85714286', 'CIRCUITOS ELECTRICOS II'),
(82, NULL, 63, 2, 7827756, '', '', '-757397.28571429', 'ADMINISTRACIÓN'),
(83, NULL, 63, 2, 7940748, '', '', '-769665.71428571', 'CALCULO I'),
(84, NULL, 63, 2, 8053740, '', '', '-781934.14285714', 'PROGRAMACION II'),
(85, NULL, 63, 2, 8166732, '', '', '-794202.57142857', 'INGLES III'),
(86, NULL, 63, 2, 8279725, '', '', '-806471', 'CONTROL INTELIGENTE'),
(87, NULL, 63, 2, 8392717, '', '', '-818739.42857143', 'ELECTIVA II: OPTATIVA'),
(88, NULL, 63, 2, 8505709, '', '', '-831007.85714286', 'OPTOELECTRONICA'),
(89, NULL, 63, 2, 8618701, '', '', '-843276.28571429', 'PLCs'),
(90, NULL, 63, 2, 8731694, '', '', '-855544.71428571', 'ELECTIVA III ESPECIALIZADA'),
(91, NULL, 63, 2, 8844686, '', '', '-867813.14285714', 'ETICA'),
(92, NULL, 63, 2, 8957678, '', '', '-880081.57142857', 'TALLER DE INVESTIGACIÓN'),
(93, NULL, 63, 2, 9070670, '', '', '-892350', 'CONTROL INTELIGENTE'),
(94, NULL, 63, 2, 9183663, '', '', '-904618.42857143', 'ELECTIVA II: OPTATIVA'),
(95, NULL, 63, 2, 9296655, '', '', '-916886.85714286', 'GESTION FINANCIERA'),
(96, NULL, 63, 2, 9409647, '', '', '-929155.28571429', 'OPTOELECTRONICA'),
(97, NULL, 63, 2, 9522639, '', '', '-941423.71428571', 'PLCs'),
(98, NULL, 63, 2, 9635632, '', '', '-953692.14285714', 'ELECTIVA III ESPECIALIZADA'),
(99, NULL, 63, 2, 9748624, '', '', '-965960.57142857', 'EDUCACIÓN Y LEGISLACIÓN AMBIENTAL'),
(100, NULL, 63, 2, 9861616, '', '', '-978229', 'TALLER DE INVESTIGACIÓN'),
(101, NULL, 63, 2, 9974608, '', '', '-990497.42857143', 'ROBOTICA'),
(102, NULL, 63, 2, 10087601, '', '', '-1002765.8571429', 'CONTROL DE PROCESOS'),
(103, NULL, 63, 2, 10200593, '', '', '-1015034.2857143', 'ELECTIVA V ESPECIALIZADA'),
(104, NULL, 63, 3, 10313585, '', '', '-1027302.7142857', 'CIRCUITOS DIGITALES III'),
(105, NULL, 63, 3, 10426577, '', '', '-1039571.1428571', 'CONTROL INTELIGENTE'),
(106, NULL, 63, 3, 10539570, '', '', '-1051839.5714286', 'ELECTIVA II: OPTATIVA'),
(107, NULL, 63, 3, 10652562, '', '', '-1064108', 'OPTOELECTRONICA'),
(108, NULL, 63, 3, 10765554, '', '', '-1076376.4285714', 'PLCs'),
(109, NULL, 63, 3, 10878546, '', '', '-1088644.8571429', 'ELECTIVA III ESPECIALIZADA'),
(110, NULL, 63, 3, 10991539, '', '', '-1100913.2857143', 'TALLER DE INVESTIGACIÓN'),
(111, NULL, 63, 4, 11104531, '', '', '-1113181.7142857', 'CONTROL INTELIGENTE'),
(112, NULL, 63, 4, 11217523, '', '', '-1125450.1428571', 'ROBOTICA II'),
(113, NULL, 63, 4, 11330515, '', '', '-1137718.5714286', 'ELECTIVA VI ESPECIALIZADA'),
(114, NULL, 63, 4, 11443508, '', '', '-1149987', 'CIRCUITOS DE POTENCIA'),
(115, NULL, 63, 4, 11556500, '', '', '-1162255.4285714', 'SISTEMA DE CONTROL II'),
(116, NULL, 63, 4, 11669492, '', '', '-1174523.8571429', 'ELECTIVA I: OPTATIVA'),
(117, NULL, 63, 4, 11782484, '', '', '-1186792.2857143', 'EDUCACIÓN Y LEGISLACIÓN AMBIENTAL'),
(118, NULL, 63, 4, 11895477, '', '', '-1199060.7142857', 'TRANSFORMACIÓN DIGITAL E INNOVACIÓN'),
(119, NULL, 63, 10, 12008469, '', '', '-1211329.1428571', 'SCADA'),
(120, NULL, 63, 10, 12121461, '', '', '-1223597.5714286', 'SOFTWARE PARA  APLICACIONES INDUSTRIALES'),
(121, NULL, 63, 10, 12234453, '', '', '-1235866', 'INGLES IV'),
(122, NULL, 63, 10, 12347446, '', '', '-1248134.4285714', 'OBSERVACIÓN DEL ENTORNO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluaciones`
--

CREATE TABLE `evaluaciones` (
  `id_evaluacion` int(11) NOT NULL,
  `id_docente` int(11) DEFAULT NULL,
  `autoevaluacion` decimal(3,2) DEFAULT NULL,
  `evaluacion_decano` decimal(3,2) DEFAULT NULL,
  `evaluacion_estudiantes` decimal(3,2) DEFAULT NULL,
  `promedio_total` decimal(3,2) DEFAULT NULL,
  `id_programa` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `evaluaciones`
--

INSERT INTO `evaluaciones` (`id_evaluacion`, `id_docente`, `autoevaluacion`, `evaluacion_decano`, `evaluacion_estudiantes`, `promedio_total`, `id_programa`) VALUES
(9, 43, 2.50, 3.50, 4.50, 5.50, 63),
(10, 44, 3.50, 4.50, 5.50, 6.50, 64),
(11, 45, 4.50, 5.50, 6.50, 4.00, 65),
(12, 46, 5.50, 6.50, 7.50, 8.50, 66),
(13, 47, 6.50, 7.50, 8.50, 9.50, 63),
(14, 48, 7.50, 8.50, 9.50, 4.00, 68),
(15, 49, 8.50, 9.50, 6.50, 4.50, 63);

--
-- Disparadores `evaluaciones`
--
DELIMITER $$
CREATE TRIGGER `trg_evaluacion_before_delete` BEFORE DELETE ON `evaluaciones` FOR EACH ROW BEGIN
    IF EXISTS (
        SELECT 1 FROM Acta_Compromiso ac
        JOIN Promedio_Evaluacion_Docente_Por_Curso p ON ac.id_promedio = p.id_promedio
        WHERE p.id_docente = OLD.id_docente
    ) THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'No se puede eliminar la evaluación: está asociada a un acta de compromiso.';
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trg_evaluacion_rango_notas` BEFORE INSERT ON `evaluaciones` FOR EACH ROW BEGIN
    IF NEW.autoevaluacion < 0 OR NEW.autoevaluacion > 5 OR
       NEW.evaluacion_decano < 0 OR NEW.evaluacion_decano > 5 OR
       NEW.evaluacion_estudiantes < 0 OR NEW.evaluacion_estudiantes > 5 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Las notas deben estar entre 0 y 5.';
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trg_validar_promedio_total` BEFORE INSERT ON `evaluaciones` FOR EACH ROW BEGIN
    DECLARE promedio_calc DECIMAL(3,2);
    SET promedio_calc = ROUND((NEW.autoevaluacion + NEW.evaluacion_decano + NEW.evaluacion_estudiantes)/3, 2);

    IF NEW.promedio_total != promedio_calc THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'El promedio total no coincide con la media de las evaluaciones.';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facultad`
--

CREATE TABLE `facultad` (
  `id_facultad` int(11) NOT NULL,
  `id_coordinacion` int(11) DEFAULT NULL,
  `nombre` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `facultad`
--

INSERT INTO `facultad` (`id_facultad`, `id_coordinacion`, `nombre`) VALUES
(1, 1, 'Facultad de Ingeniería'),
(2, 2, 'Facultad de Derecho'),
(3, 3, 'Facultad de Administración'),
(4, 4, 'Facultad de Contaduría'),
(5, 5, 'Facultad de Deporte');

--
-- Disparadores `facultad`
--
DELIMITER $$
CREATE TRIGGER `trg_facultad_before_delete` BEFORE DELETE ON `facultad` FOR EACH ROW BEGIN
    IF EXISTS (
        SELECT 1 FROM Programas WHERE id_facultad = OLD.id_facultad
    ) THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'No se puede eliminar la facultad: tiene programas asociados.';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notas_plan_mejora`
--

CREATE TABLE `notas_plan_mejora` (
  `id_notas_plan_mejora` int(11) NOT NULL,
  `id_plan_mejora` int(11) DEFAULT NULL,
  `nota` text DEFAULT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `periodos_academicos`
--

CREATE TABLE `periodos_academicos` (
  `id_periodo` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `periodos_academicos`
--

INSERT INTO `periodos_academicos` (`id_periodo`, `nombre`, `fecha_inicio`, `fecha_fin`) VALUES
(210, '2024-08-05', '2024-08-05', '2024-11-27'),
(211, '2024-08-05', '2024-08-05', '2024-11-27'),
(212, '2024-08-05', '2024-08-05', '2024-11-27'),
(213, '2024-08-05', '2024-08-05', '2024-11-27'),
(214, '2020-08-05', '2020-08-05', '2024-11-27'),
(215, '2024-08-05', '2024-08-05', '2024-11-27'),
(216, '2024-08-05', '2024-08-05', '2024-11-27'),
(217, '2024-08-05', '2024-08-05', '2024-11-27'),
(218, '2024-08-05', '2024-08-05', '2024-11-27'),
(219, NULL, NULL, NULL),
(220, NULL, NULL, NULL),
(221, NULL, NULL, NULL),
(222, NULL, NULL, NULL),
(223, NULL, NULL, NULL),
(224, NULL, NULL, NULL),
(225, NULL, NULL, NULL),
(226, NULL, NULL, NULL),
(227, NULL, NULL, NULL),
(228, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `id_permiso` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `modulo_permiso` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plan_de_mejora`
--

CREATE TABLE `plan_de_mejora` (
  `id_plan_mejora` int(11) NOT NULL,
  `id_facultad` int(11) DEFAULT NULL,
  `id_curso` int(11) DEFAULT NULL,
  `id_docente` int(11) DEFAULT NULL,
  `id_promedio` int(11) DEFAULT NULL,
  `progreso` int(11) DEFAULT NULL,
  `estado` enum('Activo','Cerrado','Pendiente') DEFAULT NULL,
  `retroalimentacion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proceso_sancion`
--

CREATE TABLE `proceso_sancion` (
  `id_proceso` int(11) NOT NULL,
  `id_docente` int(11) DEFAULT NULL,
  `id_facultad` int(11) DEFAULT NULL,
  `id_promedio` int(11) DEFAULT NULL,
  `sancion` enum('Leve','Grave','Retiro_definitivo') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proceso_sancion_retiro`
--

CREATE TABLE `proceso_sancion_retiro` (
  `id` int(11) NOT NULL,
  `id_docente` int(11) NOT NULL,
  `numero_resolucion` varchar(50) NOT NULL,
  `fecha_emision` date NOT NULL,
  `nombre_docente` varchar(100) NOT NULL,
  `apellido_docente` varchar(100) NOT NULL,
  `identificacion_docente` varchar(20) NOT NULL,
  `asignatura` varchar(100) NOT NULL,
  `calificacion_final` decimal(5,2) NOT NULL,
  `tipo_sancion` enum('leve','grave','retiro') NOT NULL,
  `antecedentes` text NOT NULL,
  `fundamentos` text NOT NULL,
  `resolucion` text NOT NULL,
  `firma` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programas`
--

CREATE TABLE `programas` (
  `id_programa` int(11) NOT NULL,
  `id_docente` int(11) DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `id_facultad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `programas`
--

INSERT INTO `programas` (`id_programa`, `id_docente`, `nombre`, `id_facultad`) VALUES
(63, 43, 'INGENIERIA ELECTRONICA', 1),
(64, 44, 'INGENIERIA SOFTWARE', 1),
(65, 45, 'INGENIERIA AMBIENTAL', 1),
(66, 46, 'DEPORTES ', 5),
(67, 47, 'INGENIERIA ELECTRONICA', 1),
(68, 48, 'DERECHO', 2),
(69, 49, 'INGENIERIA ELECTRONICA', 1);

--
-- Disparadores `programas`
--
DELIMITER $$
CREATE TRIGGER `trg_programa_before_delete` BEFORE DELETE ON `programas` FOR EACH ROW BEGIN
    IF EXISTS (
        SELECT 1 FROM Cursos WHERE id_programa = OLD.id_programa
    ) THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'No se puede eliminar el programa: tiene cursos asignados.';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `promedio_evaluacion_docente_por_curso`
--

CREATE TABLE `promedio_evaluacion_docente_por_curso` (
  `id_promedio` int(11) NOT NULL,
  `id_curso` int(11) DEFAULT NULL,
  `id_docente` int(11) DEFAULT NULL,
  `promedio_ev_docente` decimal(3,2) DEFAULT NULL,
  `promedio_notas_curso` decimal(3,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `promedio_evaluacion_docente_por_curso`
--

INSERT INTO `promedio_evaluacion_docente_por_curso` (`id_promedio`, `id_curso`, `id_docente`, `promedio_ev_docente`, `promedio_notas_curso`) VALUES
(46, 226, 43, 4.00, 3.80),
(47, 227, 44, 4.70, 2.90),
(48, 228, 45, 5.00, 3.90),
(49, 229, 46, 5.00, 3.60),
(50, 230, 47, 4.80, 4.60),
(51, 231, 48, 4.40, 3.20),
(52, 232, 49, 4.60, 3.80),
(53, 233, 49, 4.00, 2.80),
(54, 234, NULL, 5.00, 3.90),
(55, 235, NULL, 5.00, 4.20),
(56, 236, NULL, 4.70, 3.60),
(57, 237, NULL, 4.40, 3.30),
(58, 238, NULL, 4.80, 4.00),
(59, 239, NULL, 4.20, 3.50),
(60, 240, NULL, 4.30, 3.10),
(61, 241, NULL, 3.70, 3.00),
(62, 242, NULL, 4.30, 3.70),
(63, 243, NULL, 5.00, 4.70),
(64, 244, NULL, 4.60, 3.80),
(65, 245, NULL, 4.70, 3.40),
(66, 246, NULL, 4.50, 3.20),
(67, 247, NULL, 4.00, 3.90),
(68, 248, NULL, 4.70, 4.20),
(69, 249, NULL, 4.90, 4.20),
(70, 250, NULL, 4.30, 3.60),
(71, 251, NULL, 4.00, 2.60),
(72, 241, NULL, 4.50, 3.50),
(73, 241, NULL, 4.40, 2.90),
(74, 254, NULL, 4.40, 2.90),
(75, 255, NULL, 4.00, 2.20),
(76, 256, NULL, 4.90, 2.90),
(77, 257, NULL, 5.00, 2.30),
(78, 258, NULL, 4.60, 3.70),
(79, 259, NULL, 4.70, 4.30),
(80, 260, NULL, 5.00, 3.60),
(81, 261, NULL, 4.80, 4.40),
(82, 262, NULL, 4.20, 3.10),
(83, 263, NULL, 4.20, 2.60),
(84, 264, NULL, 4.80, 3.10),
(85, 265, NULL, 4.70, 4.00),
(86, 266, NULL, 5.00, 4.40),
(87, 267, NULL, 4.40, 4.60),
(88, 263, NULL, 4.30, 2.00),
(89, 263, NULL, 4.30, 2.60),
(90, 263, NULL, 4.40, 3.20);

--
-- Disparadores `promedio_evaluacion_docente_por_curso`
--
DELIMITER $$
CREATE TRIGGER `trg_promedio_eval_docente` BEFORE INSERT ON `promedio_evaluacion_docente_por_curso` FOR EACH ROW BEGIN
    IF NEW.promedio_ev_docente > 5 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'El promedio de evaluación del docente no puede ser mayor que 5.';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id_rol` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id_rol`, `nombre`, `descripcion`) VALUES
(1, 'Decano', 'Decano de la universidad'),
(2, 'Docente', 'Docente de la universidad'),
(3, 'Administrador', 'Administrador de la universidad');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `id_rol` int(11) DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  `nombre` varchar(255) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `tipo_usuario` enum('docente','coordinador','administrador') NOT NULL,
  `apellido` varchar(260) NOT NULL,
  `identificacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `id_rol`, `activo`, `nombre`, `correo`, `contrasena`, `tipo_usuario`, `apellido`, `identificacion`) VALUES
(1, 1, 1, 'Juan Pérez', 'juanperez@gmail.com', '123', 'coordinador', 'Guitierres', 10583850),
(2, 2, 1, 'Ana Gómez', 'anagomez@gmail.com', '1234', 'docente', 'Fracisco', 10458305),
(3, 2, 1, 'Carlos ruiz', 'carlosruiz@gmail.com', '123', 'docente', 'sdfs', 10304059),
(4, 2, 1, 'Laura Díaz', 'lauradiaz@gmail.com', '1234', 'docente', 'dfg', 10787593),
(5, 2, 1, 'Pedro Torres', 'pedro@gmail.com', '1243', 'docente', 'sdf', 10674849),
(6, 2, 1, 'Alejo', 'alejo@gmail.com', '1233', 'docente', 'xcv', 1934943),
(7, 2, 1, 'Cristian', 'cristian@gmail.com\r\n', '1234', 'docente', 'fgj', 1093290);

--
-- Disparadores `usuarios`
--
DELIMITER $$
CREATE TRIGGER `trg_usuario_cambio_rol` BEFORE UPDATE ON `usuarios` FOR EACH ROW BEGIN
    IF OLD.activo = TRUE AND NEW.id_rol != OLD.id_rol THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'No se puede cambiar el rol de un usuario activo.';
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trg_usuario_correo_unico` BEFORE INSERT ON `usuarios` FOR EACH ROW BEGIN
    IF EXISTS (
        SELECT 1 FROM Usuarios WHERE correo = NEW.correo
    ) THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'El correo ya está en uso.';
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trg_usuario_validar_contrasena` BEFORE INSERT ON `usuarios` FOR EACH ROW BEGIN
    IF CHAR_LENGTH(NEW.contrasena) < 8 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'La contraseña debe tener al menos 8 caracteres.';
    END IF;
END
$$
DELIMITER ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `acta_compromiso`
--
ALTER TABLE `acta_compromiso`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `numero_acta` (`numero_acta`);

--
-- Indices de la tabla `alertas_bajo_desempeno`
--
ALTER TABLE `alertas_bajo_desempeno`
  ADD PRIMARY KEY (`id_alerta`),
  ADD KEY `id_facultad` (`id_facultad`),
  ADD KEY `id_promedio` (`id_promedio`),
  ADD KEY `id_docente` (`id_docente`),
  ADD KEY `id_curso` (`id_curso`);

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id_comentario`),
  ADD KEY `id_docente` (`id_docente`),
  ADD KEY `id_programa` (`id_programa`),
  ADD KEY `id_coordinacion` (`id_coordinacion`);

--
-- Indices de la tabla `coordinacion`
--
ALTER TABLE `coordinacion`
  ADD PRIMARY KEY (`id_coordinacion`);

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id_curso`),
  ADD UNIQUE KEY `codigo` (`codigo`),
  ADD KEY `id_programa` (`id_programa`),
  ADD KEY `id_docente` (`id_docente`);

--
-- Indices de la tabla `docente`
--
ALTER TABLE `docente`
  ADD PRIMARY KEY (`id_docente`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `docentes_no_autoevaluados`
--
ALTER TABLE `docentes_no_autoevaluados`
  ADD PRIMARY KEY (`id_docente_No_Evaluado`),
  ADD KEY `id_facultad` (`id_facultad`),
  ADD KEY `id_coordinacion` (`id_coordinacion`),
  ADD KEY `id_programa` (`id_programa`),
  ADD KEY `id_docente` (`id_docente`);

--
-- Indices de la tabla `estudiantes_no_evaluaron`
--
ALTER TABLE `estudiantes_no_evaluaron`
  ADD PRIMARY KEY (`id_estudiante`),
  ADD KEY `id_programa` (`id_programa`),
  ADD KEY `id_facultad` (`id_facultad`);

--
-- Indices de la tabla `evaluaciones`
--
ALTER TABLE `evaluaciones`
  ADD PRIMARY KEY (`id_evaluacion`),
  ADD KEY `id_docente` (`id_docente`);

--
-- Indices de la tabla `facultad`
--
ALTER TABLE `facultad`
  ADD PRIMARY KEY (`id_facultad`),
  ADD KEY `id_coordinacion` (`id_coordinacion`);

--
-- Indices de la tabla `notas_plan_mejora`
--
ALTER TABLE `notas_plan_mejora`
  ADD PRIMARY KEY (`id_notas_plan_mejora`),
  ADD KEY `id_plan_mejora` (`id_plan_mejora`);

--
-- Indices de la tabla `periodos_academicos`
--
ALTER TABLE `periodos_academicos`
  ADD PRIMARY KEY (`id_periodo`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id_permiso`),
  ADD UNIQUE KEY `nombre` (`nombre`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `plan_de_mejora`
--
ALTER TABLE `plan_de_mejora`
  ADD PRIMARY KEY (`id_plan_mejora`),
  ADD KEY `id_facultad` (`id_facultad`),
  ADD KEY `id_curso` (`id_curso`),
  ADD KEY `id_docente` (`id_docente`),
  ADD KEY `id_promedio` (`id_promedio`);

--
-- Indices de la tabla `proceso_sancion`
--
ALTER TABLE `proceso_sancion`
  ADD PRIMARY KEY (`id_proceso`),
  ADD KEY `id_docente` (`id_docente`),
  ADD KEY `id_facultad` (`id_facultad`),
  ADD KEY `id_promedio` (`id_promedio`);

--
-- Indices de la tabla `proceso_sancion_retiro`
--
ALTER TABLE `proceso_sancion_retiro`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `numero_resolucion` (`numero_resolucion`),
  ADD KEY `fk_docente` (`id_docente`);

--
-- Indices de la tabla `programas`
--
ALTER TABLE `programas`
  ADD PRIMARY KEY (`id_programa`),
  ADD KEY `id_facultad` (`id_facultad`),
  ADD KEY `id_docente` (`id_docente`);

--
-- Indices de la tabla `promedio_evaluacion_docente_por_curso`
--
ALTER TABLE `promedio_evaluacion_docente_por_curso`
  ADD PRIMARY KEY (`id_promedio`),
  ADD KEY `id_curso` (`id_curso`),
  ADD KEY `id_docente` (`id_docente`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `correo` (`correo`),
  ADD KEY `id_rol` (`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `acta_compromiso`
--
ALTER TABLE `acta_compromiso`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `alertas_bajo_desempeno`
--
ALTER TABLE `alertas_bajo_desempeno`
  MODIFY `id_alerta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id_comentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=725;

--
-- AUTO_INCREMENT de la tabla `coordinacion`
--
ALTER TABLE `coordinacion`
  MODIFY `id_coordinacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id_curso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=271;

--
-- AUTO_INCREMENT de la tabla `docente`
--
ALTER TABLE `docente`
  MODIFY `id_docente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT de la tabla `docentes_no_autoevaluados`
--
ALTER TABLE `docentes_no_autoevaluados`
  MODIFY `id_docente_No_Evaluado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `estudiantes_no_evaluaron`
--
ALTER TABLE `estudiantes_no_evaluaron`
  MODIFY `id_estudiante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT de la tabla `evaluaciones`
--
ALTER TABLE `evaluaciones`
  MODIFY `id_evaluacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `facultad`
--
ALTER TABLE `facultad`
  MODIFY `id_facultad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `notas_plan_mejora`
--
ALTER TABLE `notas_plan_mejora`
  MODIFY `id_notas_plan_mejora` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `periodos_academicos`
--
ALTER TABLE `periodos_academicos`
  MODIFY `id_periodo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=229;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id_permiso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `plan_de_mejora`
--
ALTER TABLE `plan_de_mejora`
  MODIFY `id_plan_mejora` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `proceso_sancion`
--
ALTER TABLE `proceso_sancion`
  MODIFY `id_proceso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `proceso_sancion_retiro`
--
ALTER TABLE `proceso_sancion_retiro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `programas`
--
ALTER TABLE `programas`
  MODIFY `id_programa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT de la tabla `promedio_evaluacion_docente_por_curso`
--
ALTER TABLE `promedio_evaluacion_docente_por_curso`
  MODIFY `id_promedio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alertas_bajo_desempeno`
--
ALTER TABLE `alertas_bajo_desempeno`
  ADD CONSTRAINT `alertas_bajo_desempeno_ibfk_1` FOREIGN KEY (`id_facultad`) REFERENCES `facultad` (`id_facultad`),
  ADD CONSTRAINT `alertas_bajo_desempeno_ibfk_2` FOREIGN KEY (`id_promedio`) REFERENCES `promedio_evaluacion_docente_por_curso` (`id_promedio`),
  ADD CONSTRAINT `alertas_bajo_desempeno_ibfk_3` FOREIGN KEY (`id_docente`) REFERENCES `docente` (`id_docente`),
  ADD CONSTRAINT `alertas_bajo_desempeno_ibfk_4` FOREIGN KEY (`id_curso`) REFERENCES `cursos` (`id_curso`);

--
-- Filtros para la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`id_docente`) REFERENCES `docente` (`id_docente`),
  ADD CONSTRAINT `comentarios_ibfk_2` FOREIGN KEY (`id_programa`) REFERENCES `programas` (`id_programa`),
  ADD CONSTRAINT `comentarios_ibfk_3` FOREIGN KEY (`id_coordinacion`) REFERENCES `coordinacion` (`id_coordinacion`);

--
-- Filtros para la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD CONSTRAINT `cursos_ibfk_1` FOREIGN KEY (`id_programa`) REFERENCES `programas` (`id_programa`),
  ADD CONSTRAINT `cursos_ibfk_2` FOREIGN KEY (`id_docente`) REFERENCES `docente` (`id_docente`);

--
-- Filtros para la tabla `docente`
--
ALTER TABLE `docente`
  ADD CONSTRAINT `docente_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `docentes_no_autoevaluados`
--
ALTER TABLE `docentes_no_autoevaluados`
  ADD CONSTRAINT `docentes_no_autoevaluados_ibfk_1` FOREIGN KEY (`id_facultad`) REFERENCES `facultad` (`id_facultad`),
  ADD CONSTRAINT `docentes_no_autoevaluados_ibfk_2` FOREIGN KEY (`id_coordinacion`) REFERENCES `coordinacion` (`id_coordinacion`),
  ADD CONSTRAINT `docentes_no_autoevaluados_ibfk_3` FOREIGN KEY (`id_programa`) REFERENCES `programas` (`id_programa`),
  ADD CONSTRAINT `docentes_no_autoevaluados_ibfk_4` FOREIGN KEY (`id_docente`) REFERENCES `docente` (`id_docente`);

--
-- Filtros para la tabla `estudiantes_no_evaluaron`
--
ALTER TABLE `estudiantes_no_evaluaron`
  ADD CONSTRAINT `estudiantes_no_evaluaron_ibfk_1` FOREIGN KEY (`id_programa`) REFERENCES `programas` (`id_programa`),
  ADD CONSTRAINT `estudiantes_no_evaluaron_ibfk_2` FOREIGN KEY (`id_facultad`) REFERENCES `facultad` (`id_facultad`);

--
-- Filtros para la tabla `facultad`
--
ALTER TABLE `facultad`
  ADD CONSTRAINT `facultad_ibfk_1` FOREIGN KEY (`id_coordinacion`) REFERENCES `coordinacion` (`id_coordinacion`);

--
-- Filtros para la tabla `notas_plan_mejora`
--
ALTER TABLE `notas_plan_mejora`
  ADD CONSTRAINT `notas_plan_mejora_ibfk_1` FOREIGN KEY (`id_plan_mejora`) REFERENCES `plan_de_mejora` (`id_plan_mejora`);

--
-- Filtros para la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD CONSTRAINT `permisos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `plan_de_mejora`
--
ALTER TABLE `plan_de_mejora`
  ADD CONSTRAINT `plan_de_mejora_ibfk_1` FOREIGN KEY (`id_facultad`) REFERENCES `facultad` (`id_facultad`),
  ADD CONSTRAINT `plan_de_mejora_ibfk_2` FOREIGN KEY (`id_curso`) REFERENCES `cursos` (`id_curso`),
  ADD CONSTRAINT `plan_de_mejora_ibfk_3` FOREIGN KEY (`id_docente`) REFERENCES `docente` (`id_docente`),
  ADD CONSTRAINT `plan_de_mejora_ibfk_4` FOREIGN KEY (`id_promedio`) REFERENCES `promedio_evaluacion_docente_por_curso` (`id_promedio`);

--
-- Filtros para la tabla `proceso_sancion`
--
ALTER TABLE `proceso_sancion`
  ADD CONSTRAINT `proceso_sancion_ibfk_1` FOREIGN KEY (`id_docente`) REFERENCES `docente` (`id_docente`),
  ADD CONSTRAINT `proceso_sancion_ibfk_2` FOREIGN KEY (`id_facultad`) REFERENCES `facultad` (`id_facultad`),
  ADD CONSTRAINT `proceso_sancion_ibfk_3` FOREIGN KEY (`id_promedio`) REFERENCES `promedio_evaluacion_docente_por_curso` (`id_promedio`);

--
-- Filtros para la tabla `proceso_sancion_retiro`
--
ALTER TABLE `proceso_sancion_retiro`
  ADD CONSTRAINT `fk_docente` FOREIGN KEY (`id_docente`) REFERENCES `docente` (`id_docente`) ON DELETE CASCADE;

--
-- Filtros para la tabla `programas`
--
ALTER TABLE `programas`
  ADD CONSTRAINT `programas_ibfk_1` FOREIGN KEY (`id_facultad`) REFERENCES `facultad` (`id_facultad`),
  ADD CONSTRAINT `programas_ibfk_2` FOREIGN KEY (`id_docente`) REFERENCES `docente` (`id_docente`);

--
-- Filtros para la tabla `promedio_evaluacion_docente_por_curso`
--
ALTER TABLE `promedio_evaluacion_docente_por_curso`
  ADD CONSTRAINT `promedio_evaluacion_docente_por_curso_ibfk_1` FOREIGN KEY (`id_curso`) REFERENCES `cursos` (`id_curso`),
  ADD CONSTRAINT `promedio_evaluacion_docente_por_curso_ibfk_2` FOREIGN KEY (`id_docente`) REFERENCES `docente` (`id_docente`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
