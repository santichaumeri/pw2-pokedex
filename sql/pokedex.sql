-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-05-2026 a las 00:36:24
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
-- Base de datos: `pokedex`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pokemons`
--
DROP TABLE IF EXISTS `pokemons`;
CREATE TABLE `pokemons` (
  `id` int(11) NOT NULL,
  `numero_id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `tipo` enum('fuego','agua','planta','electrico','hielo','veneno','psiquico','dragon','siniestro') NOT NULL,
  `descripcion` text DEFAULT NULL,
  `imagen_ruta` varchar(255) DEFAULT NULL,
  `altura_m` decimal(4,1) DEFAULT NULL,
  `peso_kg` decimal(5,1) DEFAULT NULL,
  `habitat` varchar(100) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  `habilidad` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pokemons`
--

INSERT INTO `pokemons` (`id`, `numero_id`, `nombre`, `tipo`, `descripcion`, `imagen_ruta`, `altura_m`, `peso_kg`, `habitat`, `color`, `habilidad`) VALUES
(1, 1, 'Bulbasaur', 'planta', 'Tiene una semilla en su espalda que crece junto a él.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/1.png', 0.7, 6.9, 'bosque', 'verde', 'Espesura'),
(2, 4, 'Charmander', 'fuego', 'La llama de su cola refleja su estado de salud y energía.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/4.png', 0.6, 8.5, 'montaña', 'rojo', 'Mar Llamas'),
(3, 7, 'Squirtle', 'agua', 'Dispara agua a alta presión con gran precisión.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/7.png', 0.5, 9.0, 'mar', 'azul', 'Torrente'),
(4, 25, 'Pikachu', 'electrico', 'Almacena electricidad en las bolsas de sus mejillas.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/25.png', 0.4, 6.0, 'bosque', 'amarillo', 'Electricidad Estática'),
(5, 54, 'Psyduck', 'agua', 'Sufre constantes jaquecas que despiertan sus poderes psíquicos.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/54.png', 0.8, 19.6, 'río', 'amarillo', 'Humedad'),
(6, 63, 'Abra', 'psiquico', 'Duerme 18 horas al día pero puede usar telepatía dormido.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/63.png', 0.9, 19.5, 'ciudad', 'marrón', 'Sincronía'),
(7, 94, 'Gengar', 'siniestro', 'Se esconde en las sombras y baja la temperatura del lugar.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/94.png', 1.5, 40.5, 'ciudad', 'morado', 'Levitación'),
(8, 116, 'Horsea', 'agua', 'Nada enroscando su cola y lanza tinta para escapar.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/116.png', 0.4, 8.0, 'mar', 'azul', 'Nado Rápido'),
(9, 147, 'Dratini', 'dragon', 'Muda su piel constantemente mientras acumula energía.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/147.png', 1.8, 3.3, 'río', 'azul', 'Manto'),
(10, 246, 'Larvitar', 'siniestro', 'Come tierra y roca hasta hundirse bajo la montaña.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/246.png', 0.6, 72.0, 'montaña', 'verde', 'Cuerpo Roca');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `password`) VALUES
(1, 'admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `pokemons`
--
ALTER TABLE `pokemons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `numero_id` (`numero_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `pokemons`
--
ALTER TABLE `pokemons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
