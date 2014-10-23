
INSERT INTO `category` (`id`, `parent`, `name`, `active`, `order`) VALUES
(1, NULL, 'Nová kolekcia ', 1, 1),
(2, NULL, 'Elegantné kabelky ', 1, 2),
(3, NULL, 'Crossbody kableky ', 1, 3),
(4, NULL, 'Akciové kabelky', 1, 4);


INSERT INTO `user` (`login`, `password`, `role`) VALUES
('admin', sha1('admin'), 'admin'),
('editor', sha1('editor'), 'editor');