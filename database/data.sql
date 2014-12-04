
INSERT INTO `category` (`id`, `parent`, `name`, `webname`, `active`, `order`) VALUES
(1, NULL, 'Nová kolekcia ', 'nova-kolekcia', 1, 1),
(2, NULL, 'Elegantné kabelky ', 'elegantne-kabelky', 1, 2),
(3, NULL, 'Crossbody kableky ', 'crossbody-kableky', 1, 3),
(4, NULL, 'Akciové kabelky', 'akciove-kabelky', 1, 4);



INSERT INTO `user` (`id`, `login`, `password`, `role`) VALUES
(1, 'admin', '$2y$10$o2Enq2eAHuUIGa/0maYOYuJ9XaKijqCHj0Teut5JkmuDC9wl4RNW6', 'admin'),
(2, 'editor', '$2y$10$abCUNABTzq1aGPJa.Th36uZR0yd9.H818p943SnoBV0Yjc33lqXvu', 'editor');

INSERT INTO `file_type` (`id`, `name`, `directory`, `width`, `height`, `isimage`) VALUES
(1, 'Default uploaded image', '', 0, 0, 1);

INSERT INTO `file` (`id`, `filename`, `file_type_id`, `created`, `modified`, `deleted`) VALUES
(7, '04859b9b3cb8d7272452ca885e1f6b4d.jpg', 1, '2014-12-04 14:34:06', NULL, NULL);