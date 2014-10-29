
INSERT INTO `category` (`id`, `parent`, `name`, `active`, `order`) VALUES
(1, NULL, 'Nová kolekcia ', 1, 1),
(2, NULL, 'Elegantné kabelky ', 1, 2),
(3, NULL, 'Crossbody kableky ', 1, 3),
(4, NULL, 'Akciové kabelky', 1, 4);


INSERT INTO `user` (`id`, `login`, `password`, `role`) VALUES
(1, 'admin', '$2y$10$o2Enq2eAHuUIGa/0maYOYuJ9XaKijqCHj0Teut5JkmuDC9wl4RNW6', 'admin'),
(2, 'editor', '$2y$10$abCUNABTzq1aGPJa.Th36uZR0yd9.H818p943SnoBV0Yjc33lqXvu', 'editor');