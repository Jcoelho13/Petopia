DELETE FROM ProductNotification;
DELETE FROM PurchaseNotification;
DELETE FROM WishListNotification;
DELETE FROM ShoppingCartNotification;
DELETE FROM Notification;
DELETE FROM PurchaseDetail; 
DELETE FROM CartDetail;
DELETE FROM Product_Category;
DELETE FROM Purchase;
DELETE FROM ShoppingCart;
DELETE FROM Category;
DELETE FROM CreditCard;
DELETE FROM MBWay;
DELETE FROM User_PaymentMethod;
DELETE FROM PaymentMethod;
DELETE FROM Editor;
DELETE FROM Review;
DELETE FROM Product_WishList;
DELETE FROM Product;
DELETE FROM WishList;
DELETE FROM "users";
DELETE FROM Admin;


insert into Product ("name", image, description, price, tags, stock) values ('Dog dental chews', '/image/products/dog_treats.png', 'Premium dog dental chews for healthier smiles: fresh breath, reduced plaque, and enjoyable chewing. Enhance your dog''s oral care today.', 20.11, 'Dog', 30);
insert into Product ("name", image, description, price, tags, stock) values ('Reptile habitat', '/image/products/reptile-habitat.png', 'Optimal reptile habitats in various sizes and styles for different species. Ensure a safe and comfortable home for your scaly pets.', 91.22, 'Reptile', 12);
insert into Product ("name", image, description, price, tags, stock) values ('Guinea pig hay ball', '/image/products/guinea-pig-hay-ball.png', 'Guinea pig hay ball: Interactive toy and hay dispenser for small pets. Promotes enrichment and healthy eating for your furry friends.', 89.13, null, 73);
insert into Product ("name", image, description, price, tags, stock) values ('Reptile hides', '/image/products/reptile-hide.png', 'Providing security and comfort for your scaly companions. Choose from various sizes and designs for a stress-free, happy habitat.', 29.25, 'Reptile', 40);
insert into Product ("name", image, description, price, tags, stock) values ('Aquarium filter', '/image/products/aquarium-filter.png', 'Maintain a clean and healthy aquatic environment. Choose from various sizes and types for efficient water filtration.', 35.59, 'Fish', 51);
insert into Product ("name", image, description, price, tags, stock) values ('Hamster food bowl', '/image/products/hamster-bowl.png', 'Practical and durable, ensuring your pet''s meals are mess-free. Choose from various sizes and designs for your hamster''s needs.', 92.43, null, 41);
insert into Product ("name", image, description, price, tags, stock) values ('Hamster exercise toy', '/image/products/hamster-exercise-toy.png', 'Keep your furry friend active and engaged with our hamster exercise ball. Happy hamsters guaranteed!', 53.39, 'Hamster Small_Animals', 68);
insert into Product ("name", image, description, price, tags, stock) values ('Dog toothbrush', '/image/products/dog-toothbrush.png', 'Make oral care easy with our pet-friendly brushes. Improve your dog''s dental health for a happy, healthy smile.', 28.76, 'Dog', 40);
insert into Product ("name", image, description, price, tags, stock) values ('Hamster nesting material', '/image/products/hamster-nesting-material.png', 'Comfy and safe bedding options for your hamster''s cozy hideaway. Create a warm and secure home for your pet.', 50.33, 'Hamster Small_Animals', 94);
insert into Product ("name", image, description, price, tags, stock) values ('Dog ID tag', '/image/products/dog-tag.png', 'Personalized, durable tags to keep your furry friend safe. Ensure quick identification and contact information in case they wander.', 84.07, null, 78);
insert into Product ("name", image, description, price, tags, stock) values ('Guinea pig play tunnel', '/image/products/guinea-pig-tunnel.png', 'Fun and stimulating tunnel for small pets. Watch your guinea pigs explore and play in this interactive space.', 82.5, null, 15);
insert into Product ("name", image, description, price, tags, stock) values ('Dog dental chews', '/image/products/dog-dental-chews.png', 'Tasty oral care treats for fresher breath and healthier teeth. Keep your pup smiling with our delicious chews.', 68.06, null, 71);
insert into Product ("name", image, description, price, tags, stock) values ('Birdcage stand', '/image/products/birdcage.png', 'Sturdy and stylish stands to elevate your feathered friend''s cage. Enhance your bird''s habitat with our stands.', 88.66, 'Birds', 29);
insert into Product ("name", image, description, price, tags, stock) values ('Guinea pig tunnel system', '/image/products/guinea-pig-play-tunnel.png', 'Expandable, modular tunnels for active and curious pets. Create a maze of exploration and fun for your guinea pigs.', 55.61, 'Small_Animals', 0);
insert into Product ("name", image, description, price, tags, stock) values ('Rabbit litter pan', '/image/products/rabbit-litter-box.png', 'Easy-to-clean, odor-controlling trays for your rabbit''s hygiene. Keep their living space clean and fresh with our pans.', 45.62, 'Small_Animals', 79);
insert into Product ("name", image, description, price, tags, stock) values ('Hamster home', '/image/products/hamster-home.png', 'Cozy hideaways for your small pet. Choose from various designs to provide a safe and snug home for your hamster.', 17.9, null, 24);
insert into Product ("name", image, description, price, tags, stock) values ('Dog poop bags', '/image/products/dog-poop-bags.png', 'Convenient, eco-friendly waste management. Make cleanup hassle-free while being environmentally responsible with our durable, biodegradable bags.', 27.6, null, 55);
insert into Product ("name", image, description, price, tags, stock) values ('Cat treat dispenser', '/image/products/cat-treat-dispenser.png', 'Interactive fun for your feline friend. Stimulate their curiosity and reward them with tasty treats using our dispenser.', 20.03, 'Cat', 89);
insert into Product ("name", image, description, price, tags, stock) values ('Reptile rock hide', '/image/products/reptile-rock.png', 'Natural-looking, secure shelters for reptiles. Create a comfortable environment with our realistic and functional rock hideaways.', 14.34, null, 33);
insert into Product ("name", image, description, price, tags, stock) values ('Rabbit harness', '/image/products/rabbit-harness.png', 'Comfortable and secure way to take your bunny for a walk. Choose from various sizes and styles for your pet''s enjoyment.', 44.13, null, 61);


insert into Category ("name") values ('Corner Grooming and Hygiene');
insert into Category ("name") values ('Small Animal Accessories');
insert into Category ("name") values ('Aquatic World');
insert into Category ("name") values ('Wild Bird Feeding');
insert into Category ("name") values ('Cat Essentials');


insert into Product_Category (product_id, category_id) values (13, 4);
insert into Product_Category (product_id, category_id) values (5, 3);
insert into Product_Category (product_id, category_id) values (20, 2);
insert into Product_Category (product_id, category_id) values (6, 2);
insert into Product_Category (product_id, category_id) values (18, 5);


insert into WishList (id, user_id) values (6, 6);
insert into WishList (id, user_id) values (7, 7);
insert into WishList (id, user_id) values (8, 8);
insert into WishList (id, user_id) values (9, 9);
insert into WishList (id, user_id) values (10, 10);
-- User anónimo
insert into WishList (id, user_id) values (999999999, 999999999);


insert into Product_WishList (product_id, wishlist_id) values (9, 6);
insert into Product_WishList (product_id, wishlist_id) values (3, 6);
insert into Product_WishList (product_id, wishlist_id) values (13, 6);
insert into Product_WishList (product_id, wishlist_id) values (18, 7);
insert into Product_WishList (product_id, wishlist_id) values (18, 8);
insert into Product_WishList (product_id, wishlist_id) values (15, 6);
insert into Product_WishList (product_id, wishlist_id) values (8, 6);
insert into Product_WishList (product_id, wishlist_id) values (5, 7);
insert into Product_WishList (product_id, wishlist_id) values (19, 6);
insert into Product_WishList (product_id, wishlist_id) values (5, 8);
insert into Product_WishList (product_id, wishlist_id) values (13, 7);
insert into Product_WishList (product_id, wishlist_id) values (3, 8);
insert into Product_WishList (product_id, wishlist_id) values (19, 7);
insert into Product_WishList (product_id, wishlist_id) values (8, 10);
insert into Product_WishList (product_id, wishlist_id) values (19, 8);
insert into Product_WishList (product_id, wishlist_id) values (18, 9);
insert into Product_WishList (product_id, wishlist_id) values (2, 9);
insert into Product_WishList (product_id, wishlist_id) values (16, 9);
insert into Product_WishList (product_id, wishlist_id) values (15, 7);
insert into Product_WishList (product_id, wishlist_id) values (7, 7);
insert into Product_WishList (product_id, wishlist_id) values (1, 8);
insert into Product_WishList (product_id, wishlist_id) values (4, 9);
insert into Product_WishList (product_id, wishlist_id) values (8, 7);
insert into Product_WishList (product_id, wishlist_id) values (13, 8);
insert into Product_WishList (product_id, wishlist_id) values (17, 8);
insert into Product_WishList (product_id, wishlist_id) values (15, 8);
insert into Product_WishList (product_id, wishlist_id) values (9, 9);
insert into Product_WishList (product_id, wishlist_id) values (5, 10);
insert into Product_WishList (product_id, wishlist_id) values (7, 8);
insert into Product_WishList (product_id, wishlist_id) values (15, 9);
insert into Product_WishList (product_id, wishlist_id) values (20, 6);
insert into Product_WishList (product_id, wishlist_id) values (13, 9);
insert into Product_WishList (product_id, wishlist_id) values (13, 10);
insert into Product_WishList (product_id, wishlist_id) values (16, 10);
insert into Product_WishList (product_id, wishlist_id) values (17, 7);
insert into Product_WishList (product_id, wishlist_id) values (10, 7);
insert into Product_WishList (product_id, wishlist_id) values (12, 8);
insert into Product_WishList (product_id, wishlist_id) values (17, 9);
insert into Product_WishList (product_id, wishlist_id) values (12, 7);
insert into Product_WishList (product_id, wishlist_id) values (6, 7);
insert into Product_WishList (product_id, wishlist_id) values (18, 6);
insert into Product_WishList (product_id, wishlist_id) values (3, 9);
insert into Product_WishList (product_id, wishlist_id) values (10, 6);
insert into Product_WishList (product_id, wishlist_id) values (16, 6);
insert into Product_WishList (product_id, wishlist_id) values (12, 9);
insert into Product_WishList (product_id, wishlist_id) values (2, 6);
insert into Product_WishList (product_id, wishlist_id) values (20, 8);
insert into Product_WishList (product_id, wishlist_id) values (5, 9);
insert into Product_WishList (product_id, wishlist_id) values (10, 8);
insert into Product_WishList (product_id, wishlist_id) values (17, 6);


insert into PaymentMethod ("name") values ('Mirabelle Glasscoe');
insert into PaymentMethod ("name") values ('Audra Bowne');
insert into PaymentMethod ("name") values ('Catlaina Willarton');
insert into PaymentMethod ("name") values ('Jolene Kingswold');
insert into PaymentMethod ("name") values ('Janeen Kinny');
insert into PaymentMethod ("name") values ('Nikola Pigford');
insert into PaymentMethod ("name") values ('Davidson Derrington');
insert into PaymentMethod ("name") values ('Nehemiah Yarrow');
insert into PaymentMethod ("name") values ('Donetta Squibbes');
insert into PaymentMethod ("name") values ('Alfy Blackburne');
insert into PaymentMethod ("name") values ('Lyndel O''Logan');
insert into PaymentMethod ("name") values ('Shanon Pickup');
insert into PaymentMethod ("name") values ('Berta Tschirschky');
insert into PaymentMethod ("name") values ('Norton Simonou');
insert into PaymentMethod ("name") values ('Margalit Kerkham');
insert into PaymentMethod ("name") values ('Geno Oulett');
insert into PaymentMethod ("name") values ('Nevil Girauld');
insert into PaymentMethod ("name") values ('Lorrie Vanlint');
insert into PaymentMethod ("name") values ('Arron Gaddie');
insert into PaymentMethod ("name") values ('Karney Bestall');
insert into PaymentMethod ("name") values ('Billie Timmons');
insert into PaymentMethod ("name") values ('Leonerd Sandeford');
insert into PaymentMethod ("name") values ('Jerome Baish');
insert into PaymentMethod ("name") values ('Rivy Pawlaczyk');
insert into PaymentMethod ("name") values ('Terrel Staniford');
insert into PaymentMethod ("name") values ('Marlon Avarne');
insert into PaymentMethod ("name") values ('Taite Grovier');
insert into PaymentMethod ("name") values ('Felipe Carpe');
insert into PaymentMethod ("name") values ('Janaye McReidy');
insert into PaymentMethod ("name") values ('Georgianna Candlish');
insert into PaymentMethod ("name") values ('Eadie Cutbush');
insert into PaymentMethod ("name") values ('Randi Van Hesteren');
insert into PaymentMethod ("name") values ('Kassia Fripps');
insert into PaymentMethod ("name") values ('Alica Brownlow');
insert into PaymentMethod ("name") values ('Marysa Ortes');
insert into PaymentMethod ("name") values ('Mickie Frudd');
insert into PaymentMethod ("name") values ('Nichol Mocker');
insert into PaymentMethod ("name") values ('Noll Munt');
insert into PaymentMethod ("name") values ('Loella Hilldrop');
insert into PaymentMethod ("name") values ('Sibyl Jindrak');
insert into PaymentMethod ("name") values ('Sapphira Sloy');
insert into PaymentMethod ("name") values ('Cristina Tarbard');
insert into PaymentMethod ("name") values ('Alli Jouning');
insert into PaymentMethod ("name") values ('Royal McCosh');
insert into PaymentMethod ("name") values ('Cher Antonikov');
insert into PaymentMethod ("name") values ('Livia Goggins');
insert into PaymentMethod ("name") values ('Constantina Tewkesberry');
insert into PaymentMethod ("name") values ('Lotti Saffle');
insert into PaymentMethod ("name") values ('Tim Capey');
insert into PaymentMethod ("name") values ('Dre Gowan');
insert into PaymentMethod ("name") values ('Emlynn Gillhespy');
insert into PaymentMethod ("name") values ('Leonie Donohue');
insert into PaymentMethod ("name") values ('Diannne Grannell');
insert into PaymentMethod ("name") values ('Maryann Loosmore');
insert into PaymentMethod ("name") values ('Wadsworth Moyle');
insert into PaymentMethod ("name") values ('Jerrie Dybell');
insert into PaymentMethod ("name") values ('Cacilie Spenclay');
insert into PaymentMethod ("name") values ('Livy Elnor');
insert into PaymentMethod ("name") values ('Lola Carass');
insert into PaymentMethod ("name") values ('Nealon Dun');
insert into PaymentMethod ("name") values ('Charita Tolomelli');
insert into PaymentMethod ("name") values ('Samaria Espino');
insert into PaymentMethod ("name") values ('Roxana Hughlock');
insert into PaymentMethod ("name") values ('Roberta Wevell');
insert into PaymentMethod ("name") values ('Ernesto Sailes');
insert into PaymentMethod ("name") values ('Raul Freeth');
insert into PaymentMethod ("name") values ('Kacie Guidera');
insert into PaymentMethod ("name") values ('Creight Latimer');
insert into PaymentMethod ("name") values ('Nealon Rignall');
insert into PaymentMethod ("name") values ('Madelin Killoran');
insert into PaymentMethod ("name") values ('Fabien Sadry');
insert into PaymentMethod ("name") values ('Ginger Tocknell');
insert into PaymentMethod ("name") values ('Colver Beazleeeigh');
insert into PaymentMethod ("name") values ('Fidelia Kann');
insert into PaymentMethod ("name") values ('Cele De Blasio');
insert into PaymentMethod ("name") values ('Dulce Dabney');
insert into PaymentMethod ("name") values ('Hilary Louch');
insert into PaymentMethod ("name") values ('Carmelia Sikorsky');
insert into PaymentMethod ("name") values ('Allissa Slott');
insert into PaymentMethod ("name") values ('Merola McClure');
insert into PaymentMethod ("name") values ('Fiorenze Cescot');
insert into PaymentMethod ("name") values ('Jesselyn Dresse');
insert into PaymentMethod ("name") values ('Sigismundo Churchley');
insert into PaymentMethod ("name") values ('Hilly Derobert');
insert into PaymentMethod ("name") values ('Marlyn Deetch');
insert into PaymentMethod ("name") values ('Ezequiel Lechelle');
insert into PaymentMethod ("name") values ('Zak Gerrans');
insert into PaymentMethod ("name") values ('Inger Ivanyushkin');
insert into PaymentMethod ("name") values ('Ferguson Balleine');
insert into PaymentMethod ("name") values ('Sherm Hurd');
insert into PaymentMethod ("name") values ('Major Gowland');
insert into PaymentMethod ("name") values ('Zerk Mahady');
insert into PaymentMethod ("name") values ('Sapphire Ronan');
insert into PaymentMethod ("name") values ('Trixy Farres');
insert into PaymentMethod ("name") values ('Celesta Mouget');
insert into PaymentMethod ("name") values ('Kenon Reuven');
insert into PaymentMethod ("name") values ('Niels Jaggs');
insert into PaymentMethod ("name") values ('Rodrique aaCassy');
insert into PaymentMethod ("name") values ('Luci Eykelbosch');
insert into PaymentMethod ("name") values ('Suki Maddock');


insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (1, '5391463850567377', 768513, '2023-05-30 09:48:03');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (2, '5477190643056882', 771256, '2023-08-14 02:03:10');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (3, '5007668450590530', 948640, '2022-12-22 06:21:05');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (4, '5010125676401542', 88426, '2023-02-06 22:30:27');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (5, '5108750143824944', 394746, '2023-06-29 15:02:53');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (6, '5183786897709442', 974695, '2023-10-12 18:24:37');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (7, '5100144980316834', 748897, '2023-07-25 13:08:46');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (8, '5100146171693640', 170025, '2023-06-10 03:45:08');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (9, '5301128918880554', 872454, '2023-01-21 16:31:20');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (10, '5048372345166462', 820199, '2023-03-17 22:42:25');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (11, '5100143813280688', 275722, '2023-01-09 22:03:49');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (12, '5007664994636251', 836276, '2023-06-09 18:29:24');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (13, '5100145915482302', 876642, '2023-05-09 13:40:01');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (14, '5002353223380791', 972753, '2022-12-15 19:30:25');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (15, '5100132940421851', 706846, '2023-08-27 07:06:13');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (16, '5543911489594995', 890348, '2023-02-25 19:54:33');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (17, '5437872094220435', 431289, '2022-11-12 00:38:03');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (18, '5100148192109150', 489710, '2022-12-04 11:34:17');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (19, '5259153838058059', 799515, '2023-03-05 07:23:24');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (20, '5226663644260756', 192465, '2022-10-25 19:36:49');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (21, '5007663236155393', 130976, '2023-08-05 03:51:06');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (22, '5318661369576884', 324568, '2023-08-21 10:27:29');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (23, '5359622544047357', 415051, '2023-09-21 16:34:27');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (24, '5100179417796190', 222816, '2022-11-15 05:47:11');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (25, '5318104073929743', 727501, '2022-12-13 02:21:40');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (26, '5100144177450511', 846607, '2023-02-15 23:50:40');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (27, '5048376267131677', 133703, '2023-07-20 23:59:47');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (28, '5366934181683464', 767063, '2023-06-08 08:16:13');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (29, '5364206094050970', 362086, '2023-08-08 15:16:50');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (30, '5108755566002761', 800866, '2023-03-14 00:14:59');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (31, '5465443895084894', 793762, '2022-11-05 12:37:07');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (32, '5420644691894469', 411871, '2023-06-29 14:27:04');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (33, '5275511357485492', 559232, '2023-03-27 00:33:55');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (34, '5520039588910412', 298170, '2023-07-07 09:02:30');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (35, '5455452143898973', 141550, '2023-05-12 10:16:13');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (36, '5100170302363949', 63952, '2023-01-30 09:30:59');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (37, '5322119068858933', 15407, '2023-03-05 05:13:18');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (38, '5010127509940225', 39917, '2023-04-07 11:15:56');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (39, '5100177350372086', 520640, '2023-08-03 06:40:14');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (40, '5100149311554235', 539240, '2023-03-14 06:09:54');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (41, '5100133897094790', 588907, '2023-02-25 01:12:40');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (42, '5007663240365210', 425814, '2023-04-15 14:29:14');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (43, '5403074352755810', 223324, '2023-09-19 11:34:46');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (44, '5100141893771659', 661380, '2023-04-30 01:37:37');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (45, '5108755350568449', 566462, '2023-01-19 12:33:48');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (46, '5502480606976427', 357850, '2023-02-01 21:39:15');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (47, '5100146438384751', 574349, '2023-07-04 19:16:07');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (48, '5048378197306684', 526763, '2023-02-23 18:48:19');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (49, '5048375777083329', 456091, '2023-05-19 07:05:06');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (50, '5100178896896489', 900896, '2023-09-18 17:29:25');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (51, '5108757323561691', 153936, '2023-02-11 16:11:42');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (52, '5187171281803323', 666625, '2023-08-03 08:11:04');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (53, '5048377803964274', 611011, '2023-05-11 00:11:18');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (54, '5002358429907875', 133015, '2022-11-14 15:16:40');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (55, '5048374075831927', 303736, '2023-03-18 11:33:29');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (56, '5048370242383941', 154740, '2023-01-21 02:34:52');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (57, '5278600873820196', 54635, '2023-06-24 00:37:39');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (58, '5515576546685195', 828666, '2023-04-16 07:58:18');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (59, '5108759132358954', 891082, '2023-03-23 20:34:56');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (60, '5002359920270318', 414220, '2023-04-06 07:28:35');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (61, '5527901848708014', 442505, '2023-02-08 02:22:47');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (62, '5415923892317828', 58262, '2022-12-31 06:07:13');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (63, '5002350877771978', 212120, '2023-01-16 23:57:51');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (64, '5455767474011866', 949291, '2023-03-12 03:10:06');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (65, '5100132170553035', 12120, '2023-06-21 17:49:49');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (66, '5334887288015791', 166260, '2023-04-11 00:40:14');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (67, '5148628774008981', 692501, '2023-05-03 22:56:44');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (68, '5002351666948074', 657612, '2023-02-10 03:04:39');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (69, '5010124198571114', 222399, '2023-02-13 12:04:27');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (70, '5100173672412486', 370856, '2023-10-07 05:37:40');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (71, '5048373216566210', 500472, '2023-06-06 06:10:58');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (72, '5180642020969432', 270951, '2023-06-28 13:48:41');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (73, '5048370151501970', 715829, '2023-01-21 19:15:23');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (74, '5002357675932447', 744420, '2022-11-09 10:45:45');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (75, '5007660665088509', 271171, '2023-02-03 07:26:41');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (76, '5501007839253349', 632161, '2022-12-04 05:49:33');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (77, '5108756263117217', 748149, '2023-07-27 20:31:45');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (78, '5378173965483082', 139047, '2023-02-22 03:58:48');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (79, '5493404733522764', 916592, '2023-02-16 12:37:34');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (80, '5048375947018353', 657095, '2023-08-07 11:35:08');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (81, '5048371135105680', 53490, '2023-02-28 02:21:02');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (82, '5553756889009236', 19587, '2023-09-28 11:19:17');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (83, '5002359351956047', 838609, '2023-10-14 08:38:58');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (84, '5589638055962976', 827276, '2023-08-08 22:37:15');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (85, '5425253891547326', 249511, '2023-03-05 18:11:49');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (86, '5010128521983060', 212934, '2023-02-18 18:45:37');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (87, '5002355639036081', 589387, '2022-11-28 14:06:18');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (88, '5007660625371839', 231869, '2023-02-24 18:09:42');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (89, '5305979980891549', 740078, '2022-12-30 09:31:27');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (90, '5108751573118823', 362171, '2023-09-11 19:56:05');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (91, '5048379169962942', 113224, '2023-05-11 03:10:52');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (92, '5100173034652555', 496752, '2023-07-16 17:37:53');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (93, '5214628934042549', 811952, '2023-06-30 03:04:04');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (94, '5002358889865894', 216369, '2023-03-12 19:06:54');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (95, '5580403645725006', 883255, '2022-12-04 08:54:27');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (96, '5002354472936853', 993191, '2023-01-09 12:40:29');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (97, '5118141580086114', 26171, '2023-04-17 22:39:43');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (98, '5100177336227024', 931482, '2023-02-24 20:52:31');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (99, '5461740424349472', 728136, '2023-06-03 12:21:36');
insert into CreditCard (paymentMethod_id, cvv, "number", "date") values (100, '5010125210854776', 268309, '2023-01-18 09:17:22');


insert into MBWay (paymentMethod_id, phoneNumber) values (1, '+48 429 979 6421');
insert into MBWay (paymentMethod_id, phoneNumber) values (2, '+261 518 936 2031');
insert into MBWay (paymentMethod_id, phoneNumber) values (3, '+33 479 658 3844');
insert into MBWay (paymentMethod_id, phoneNumber) values (4, '+54 433 463 2343');
insert into MBWay (paymentMethod_id, phoneNumber) values (5, '+1 314 151 7851');
insert into MBWay (paymentMethod_id, phoneNumber) values (6, '+81 207 161 7338');
insert into MBWay (paymentMethod_id, phoneNumber) values (7, '+595 824 756 7951');
insert into MBWay (paymentMethod_id, phoneNumber) values (8, '+86 555 554 3226');
insert into MBWay (paymentMethod_id, phoneNumber) values (9, '+48 842 511 2261');
insert into MBWay (paymentMethod_id, phoneNumber) values (10, '+56 775 799 7497');
insert into MBWay (paymentMethod_id, phoneNumber) values (11, '+86 463 392 0883');
insert into MBWay (paymentMethod_id, phoneNumber) values (12, '+66 433 228 4765');
insert into MBWay (paymentMethod_id, phoneNumber) values (13, '+86 975 665 0842');
insert into MBWay (paymentMethod_id, phoneNumber) values (14, '+62 350 155 9582');
insert into MBWay (paymentMethod_id, phoneNumber) values (15, '+381 956 262 6299');
insert into MBWay (paymentMethod_id, phoneNumber) values (16, '+46 188 237 5878');
insert into MBWay (paymentMethod_id, phoneNumber) values (17, '+62 977 729 6930');
insert into MBWay (paymentMethod_id, phoneNumber) values (18, '+86 568 123 4535');
insert into MBWay (paymentMethod_id, phoneNumber) values (19, '+7 691 285 1213');
insert into MBWay (paymentMethod_id, phoneNumber) values (20, '+218 947 288 2294');
insert into MBWay (paymentMethod_id, phoneNumber) values (21, '+351 160 350 1346');
insert into MBWay (paymentMethod_id, phoneNumber) values (22, '+976 329 581 6854');
insert into MBWay (paymentMethod_id, phoneNumber) values (23, '+62 436 604 5893');
insert into MBWay (paymentMethod_id, phoneNumber) values (24, '+62 897 366 7000');
insert into MBWay (paymentMethod_id, phoneNumber) values (25, '+46 204 858 4232');
insert into MBWay (paymentMethod_id, phoneNumber) values (26, '+381 263 927 4319');
insert into MBWay (paymentMethod_id, phoneNumber) values (27, '+86 767 491 4316');
insert into MBWay (paymentMethod_id, phoneNumber) values (28, '+86 828 589 6385');
insert into MBWay (paymentMethod_id, phoneNumber) values (29, '+94 136 451 3434');
insert into MBWay (paymentMethod_id, phoneNumber) values (30, '+33 425 812 4440');
insert into MBWay (paymentMethod_id, phoneNumber) values (31, '+62 130 595 6314');
insert into MBWay (paymentMethod_id, phoneNumber) values (32, '+51 240 884 6774');
insert into MBWay (paymentMethod_id, phoneNumber) values (33, '+48 531 482 3266');
insert into MBWay (paymentMethod_id, phoneNumber) values (34, '+351 253 953 5986');
insert into MBWay (paymentMethod_id, phoneNumber) values (35, '+689 379 811 8424');
insert into MBWay (paymentMethod_id, phoneNumber) values (36, '+48 890 747 5577');
insert into MBWay (paymentMethod_id, phoneNumber) values (37, '+1 402 501 1196');
insert into MBWay (paymentMethod_id, phoneNumber) values (38, '+225 208 666 7649');
insert into MBWay (paymentMethod_id, phoneNumber) values (39, '+53 447 359 5160');
insert into MBWay (paymentMethod_id, phoneNumber) values (40, '+57 755 256 8308');
insert into MBWay (paymentMethod_id, phoneNumber) values (41, '+86 393 471 4332');
insert into MBWay (paymentMethod_id, phoneNumber) values (42, '+7 884 281 3502');
insert into MBWay (paymentMethod_id, phoneNumber) values (43, '+351 782 228 6407');
insert into MBWay (paymentMethod_id, phoneNumber) values (44, '+33 993 966 5161');
insert into MBWay (paymentMethod_id, phoneNumber) values (45, '+86 281 129 4192');
insert into MBWay (paymentMethod_id, phoneNumber) values (46, '+1 305 653 0532');
insert into MBWay (paymentMethod_id, phoneNumber) values (47, '+62 891 504 7443');
insert into MBWay (paymentMethod_id, phoneNumber) values (48, '+54 963 132 7288');
insert into MBWay (paymentMethod_id, phoneNumber) values (49, '+51 326 542 3663');
insert into MBWay (paymentMethod_id, phoneNumber) values (50, '+63 515 521 9285');
insert into MBWay (paymentMethod_id, phoneNumber) values (51, '+55 333 262 9116');
insert into MBWay (paymentMethod_id, phoneNumber) values (52, '+62 125 453 6123');
insert into MBWay (paymentMethod_id, phoneNumber) values (53, '+62 573 584 2435');
insert into MBWay (paymentMethod_id, phoneNumber) values (54, '+81 373 908 5377');
insert into MBWay (paymentMethod_id, phoneNumber) values (55, '+86 870 706 5370');
insert into MBWay (paymentMethod_id, phoneNumber) values (56, '+86 462 810 1085');
insert into MBWay (paymentMethod_id, phoneNumber) values (57, '+82 947 431 9010');
insert into MBWay (paymentMethod_id, phoneNumber) values (58, '+373 127 917 0169');
insert into MBWay (paymentMethod_id, phoneNumber) values (59, '+66 791 535 8161');
insert into MBWay (paymentMethod_id, phoneNumber) values (60, '+62 949 780 1460');
insert into MBWay (paymentMethod_id, phoneNumber) values (61, '+62 283 512 7864');
insert into MBWay (paymentMethod_id, phoneNumber) values (62, '+353 515 330 8187');
insert into MBWay (paymentMethod_id, phoneNumber) values (63, '+62 820 262 2866');
insert into MBWay (paymentMethod_id, phoneNumber) values (64, '+593 759 509 1748');
insert into MBWay (paymentMethod_id, phoneNumber) values (65, '+63 709 133 3495');
insert into MBWay (paymentMethod_id, phoneNumber) values (66, '+86 914 717 0033');
insert into MBWay (paymentMethod_id, phoneNumber) values (67, '+55 256 430 8829');
insert into MBWay (paymentMethod_id, phoneNumber) values (68, '+47 257 455 6493');
insert into MBWay (paymentMethod_id, phoneNumber) values (69, '+48 958 455 3533');
insert into MBWay (paymentMethod_id, phoneNumber) values (70, '+970 280 957 5193');
insert into MBWay (paymentMethod_id, phoneNumber) values (71, '+225 592 843 8055');
insert into MBWay (paymentMethod_id, phoneNumber) values (72, '+1 812 763 9116');
insert into MBWay (paymentMethod_id, phoneNumber) values (73, '+86 287 922 3529');
insert into MBWay (paymentMethod_id, phoneNumber) values (74, '+86 861 263 9634');
insert into MBWay (paymentMethod_id, phoneNumber) values (75, '+1 510 253 9904');
insert into MBWay (paymentMethod_id, phoneNumber) values (76, '+420 909 268 7788');
insert into MBWay (paymentMethod_id, phoneNumber) values (77, '+267 540 678 9052');
insert into MBWay (paymentMethod_id, phoneNumber) values (78, '+351 411 796 9363');
insert into MBWay (paymentMethod_id, phoneNumber) values (79, '+63 792 108 2214');
insert into MBWay (paymentMethod_id, phoneNumber) values (80, '+62 725 464 2262');
insert into MBWay (paymentMethod_id, phoneNumber) values (81, '+62 922 783 9878');
insert into MBWay (paymentMethod_id, phoneNumber) values (82, '+374 376 153 5355');
insert into MBWay (paymentMethod_id, phoneNumber) values (83, '+351 685 459 6590');
insert into MBWay (paymentMethod_id, phoneNumber) values (84, '+47 350 175 1794');
insert into MBWay (paymentMethod_id, phoneNumber) values (85, '+49 528 224 4610');
insert into MBWay (paymentMethod_id, phoneNumber) values (86, '+57 273 159 9458');
insert into MBWay (paymentMethod_id, phoneNumber) values (87, '+63 643 260 3254');
insert into MBWay (paymentMethod_id, phoneNumber) values (88, '+30 697 747 7870');
insert into MBWay (paymentMethod_id, phoneNumber) values (89, '+62 719 462 8997');
insert into MBWay (paymentMethod_id, phoneNumber) values (90, '+58 130 393 0768');
insert into MBWay (paymentMethod_id, phoneNumber) values (91, '+385 650 498 5070');
insert into MBWay (paymentMethod_id, phoneNumber) values (92, '+86 970 971 4041');
insert into MBWay (paymentMethod_id, phoneNumber) values (93, '+375 901 426 7313');
insert into MBWay (paymentMethod_id, phoneNumber) values (94, '+965 533 263 1726');
insert into MBWay (paymentMethod_id, phoneNumber) values (95, '+51 131 567 4417');
insert into MBWay (paymentMethod_id, phoneNumber) values (96, '+48 247 268 7664');
insert into MBWay (paymentMethod_id, phoneNumber) values (97, '+62 520 103 5815');
insert into MBWay (paymentMethod_id, phoneNumber) values (98, '+355 610 206 1886');
insert into MBWay (paymentMethod_id, phoneNumber) values (99, '+93 277 577 2226');
insert into MBWay (paymentMethod_id, phoneNumber) values (100, '+86 666 371 5885');


insert into ShoppingCart (user_id) values (6);
insert into ShoppingCart (user_id) values (7);
insert into ShoppingCart (user_id) values (8);
insert into ShoppingCart (user_id) values (9);
insert into ShoppingCart (user_id) values (10);
-- User anónimo
insert into ShoppingCart (id, user_id) values (999999999, 999999999);

insert into "users" (email, "password", "name", profile_image, remember_token, is_admin) values ('admin@example.com', '$2y$10$T6uHU/54zm8NJglIO5SwDuq1bgFhY6QGcJXVgZ4vNSH1WVNNzrx5G', 'Admin Example', '/image/profile.png', '', 1);
insert into "users" (email, "password", "name", profile_image, remember_token, is_admin) values ('etipton1@accuweather.com', '$2a$04$MSdprabyX2Xs12EUrPtjveM/I/omWaKcTbTcM47jgb4WaDMX4HJ/m', 'Evie Tipton', '/image/profile.png', '', 1);
insert into "users" (email, "password", "name", profile_image, remember_token, is_admin) values ('kromanetti2@mac.com', '$2a$04$kMBXwbvVJkdP.dymdPFmyulcf7zw.Kb58NPMimgvNIOlR0/vqj34a', 'Kareem Romanetti', '/image/profile.png', '', 1);
insert into "users" (email, "password", "name", profile_image, remember_token, is_admin) values ('jclaricoats3@bloomberg.com', '$2a$04$750KrisWLRUrUVKeF/z/W.oiVUQ9KzjnIsDNRXYpsJmROcTS.Klb2', 'Jamie Claricoats', '/image/profile.png', '', 1);
insert into "users" (email, "password", "name", profile_image, remember_token, is_admin) values ('dwesson4@blogs.com', '$2a$04$SBulYCbzR6S1pWsTCBTZ9OfZyp3Z6S98kgFeUh.hLQDTJ7FiXdhWK', 'Dot Wesson', '/image/profile.png', '', 1);
insert into "users" (email, "password", "name", profile_image, remember_token, isbanned,  is_admin) values ('user@example.com', '$2y$10$MrrYSes/PNFFrxqMiSCnSevWa/t4YHukftodg4X3v1uWQW589b036', 'GlobalUser Example', '/image/profile.png', '', 0, 0);
insert into "users" (email, "password", "name", profile_image, remember_token, isbanned, is_admin) values ('mpinniger6@mediafire.com', '$2a$04$YJ1MJo2kRXu.mwaPhoMft.HOJaMVh1fqNa45XW1yaAkjg3E81QjVy', 'Meier Pinniger', '/image/profile.png', '', 0, 0);
insert into "users" (email, "password", "name", profile_image, remember_token, isbanned, is_admin) values ('cdiggles7@psu.edu', '$2a$04$Y6SURBv.t/gSPLgqwO42Y..xbvYRMS.F.jp1QXBLspcWegyt9V/g2', 'Cathe Diggles', '/image/profile.png', '', 0, 0);
insert into "users" (email, "password", "name", profile_image, remember_token, isbanned, is_admin) values ('foregan8@usgs.gov', '$2a$04$KGjLm/WxPN3s67jiUdRx4.UF4KhwWoXiHPrUfwnYUcw0D80aPPvp2', 'Fiona O''Regan', '/image/profile.png', '', 0, 0);
insert into "users" (email, "password", "name", profile_image, remember_token, isbanned, is_admin) values ('epigford9@jigsy.com', '$2a$04$ADWHy.xFOt3r1uAlZVim..3/CVILs15b5D/bfjLn8r0PwtuuGXH9u', 'Eddy Pigford', '/image/profile.png', '', 0, 0);
-- User anónimo
insert into "users" (id, email, "password", "name", profile_image, remember_token, isbanned, is_admin) values (999999999, 'anonymous@anonymous.com', '$2a$12$mdYFPZxtnc3bhH/V3RzoheWCNn5c46q4PrK50atHDjKtb0d2VTRpi', 'Anonymous', '/image/profile.png', '', 0, 0);

insert into Admin (id) values (1);
insert into Admin (id) values (2);
insert into Admin (id) values (3);
insert into Admin (id) values (4);
insert into Admin (id) values (5);

insert into "user"(id, admin_id, wishlist_id, shoppingcart_id, wallet) values (6, null, 6, 1, 50.00);
insert into "user"(id, admin_id, wishlist_id, shoppingcart_id, wallet) values (7, null, 7, 2, 50.00);
insert into "user"(id, admin_id, wishlist_id, shoppingcart_id, wallet) values (8, null, 8, 3, 50.00);
insert into "user"(id, admin_id, wishlist_id, shoppingcart_id, wallet) values (9, null, 9, 4, 50.00);
insert into "user"(id, admin_id, wishlist_id, shoppingcart_id, wallet) values (10, null, 10, 5, 50.00);
-- User anónimo
insert into "user"(id, admin_id, wishlist_id, shoppingcart_id, wallet) values (999999999, null, 999999999, 999999999, 0.00);


insert into Editor (admin_id, product_id) values (5, 1);
insert into Editor (admin_id, product_id) values (1, 2);
insert into Editor (admin_id, product_id) values (2, 3);
insert into Editor (admin_id, product_id) values (4, 4);
insert into Editor (admin_id, product_id) values (3, 5);

insert into Purchase (user_id, paymentMethod_id, tracking_status, tracking_number, "date", address) values (6, 64, 'In transit', 100, '2023-04-08 15:14:15', 'Rua da Boavista, 123');
insert into Purchase (user_id, paymentMethod_id, tracking_status, tracking_number, "date", address) values (6, 15, 'Delay', null, '2023-05-13 06:48:27', 'Rua da Boavista, 123');
insert into Purchase (user_id, paymentMethod_id, tracking_status, tracking_number, "date", address) values (6, 42, 'Delay', null, '2023-04-10 13:38:54', 'Rua da Boavista, 123');
insert into Purchase (user_id, paymentMethod_id, tracking_status, tracking_number, "date", address) values (7, 12, 'Return to sender', null, '2023-08-07 06:59:20', 'Rua da Boavista, 123');
insert into Purchase (user_id, paymentMethod_id, tracking_status, tracking_number, "date", address) values (8, 94, 'In transit', null, '2023-06-06 21:52:06', 'Rua da Boavista, 123');
insert into Purchase (user_id, paymentMethod_id, tracking_status, tracking_number, "date", address) values (9, 66, 'Delivered', null, '2023-04-09 22:29:27', 'Rua da Boavista, 123');
insert into Purchase (user_id, paymentMethod_id, tracking_status, tracking_number, "date", address) values (10, 71, 'Shipping label created', null, '2023-01-01 07:34:17', 'Rua da Boavista, 123');
insert into Purchase (user_id, paymentMethod_id, tracking_status, tracking_number, "date", address) values (10, 77, 'In transit', null, '2023-03-16 02:43:28', 'Rua da Boavista, 123');
insert into Purchase (user_id, paymentMethod_id, tracking_status, tracking_number, "date", address) values (6, 76, 'Delivered', null, '2023-04-22 01:21:17', 'Rua da Boavista, 123');
insert into Purchase (user_id, paymentMethod_id, tracking_status, tracking_number, "date", address) values (7, 67, 'Delivered', 345, '2023-06-13 01:32:41', 'Rua da Boavista, 123');

insert into PurchaseDetail (purchase_id, product_id, quantity, price) values (5, 19, 7, 10);
insert into PurchaseDetail (purchase_id, product_id, quantity, price) values (1, 2, 5, 10);
insert into PurchaseDetail (purchase_id, product_id, quantity, price) values (1, 1, 2, 10);
insert into PurchaseDetail (purchase_id, product_id, quantity, price) values (2, 1, 8, 10);
insert into PurchaseDetail (purchase_id, product_id, quantity, price) values (5, 14, 9, 10);
insert into PurchaseDetail (purchase_id, product_id, quantity, price) values (4, 20, 6, 10);
insert into PurchaseDetail (purchase_id, product_id, quantity, price) values (2, 15, 9, 10);
insert into PurchaseDetail (purchase_id, product_id, quantity, price) values (7, 1, 3, 10);
insert into PurchaseDetail (purchase_id, product_id, quantity, price) values (7, 7, 8, 10);
insert into PurchaseDetail (purchase_id, product_id, quantity, price) values (6, 15, 7, 10);

insert into Review (user_id, product_id, "date", body, title, rating) values (6, 1, '2022-12-21 18:18:38', 'Legit review', 'I love it! It''s high-quality and my pet adores it. Fast shipping and excellent service!', 5);
insert into Review (user_id, product_id, "date", body, title, rating) values (7, 2, '2023-08-18 02:06:05', null, null, 3);
insert into Review (user_id, product_id, "date", body, title, rating) values (7, 3, '2023-10-16 23:10:05', 'Horrible product', null, 1);
insert into Review (user_id, product_id, "date", body, title, rating) values (10, 5, '2023-06-14 14:51:54', null, null, 3);
insert into Review (user_id, product_id, "date", body, title, rating) values (7, 5, '2023-04-09 16:40:50', 'AMAZING!!', 'My pet loves it although the shipping could have been a bit faster. ', 4);
insert into Review (user_id, product_id, "date", body, title, rating) values (8, 6, '2022-10-31 11:18:18', null, null, 1);
insert into Review (user_id, product_id, "date", body, title, rating) values (9, 7, '2023-06-18 18:15:55', null, null, 4);
insert into Review (user_id, product_id, "date", body, title, rating) values (9, 9, '2023-01-22 00:42:19', null, null, 2);
insert into Review (user_id, product_id, "date", body, title, rating) values (10, 9, '2022-11-30 23:37:05', null, null, 3);
insert into Review (user_id, product_id, "date", body, title, rating) values (6, 10, '2023-09-04 21:11:33', null, null, 4);

insert into CartDetail (shoppingCart_id, product_id, quantity) values (1, 10, 3);
insert into CartDetail (shoppingCart_id, product_id, quantity) values (2, 3, 10);
insert into CartDetail (shoppingCart_id, product_id, quantity) values (3, 15, 5);
insert into CartDetail (shoppingCart_id, product_id, quantity) values (4, 16, 9);
insert into CartDetail (shoppingCart_id, product_id, quantity) values (5, 1, 9);
insert into CartDetail (shoppingCart_id, product_id, quantity) values (1, 3, 5);
insert into CartDetail (shoppingCart_id, product_id, quantity) values (2, 11, 9);
insert into CartDetail (shoppingCart_id, product_id, quantity) values (3, 6, 7);
insert into CartDetail (shoppingCart_id, product_id, quantity) values (4, 17, 1);
insert into CartDetail (shoppingCart_id, product_id, quantity) values (5, 2, 6);
insert into CartDetail (shoppingCart_id, product_id, quantity) values (1, 4, 1);
insert into CartDetail (shoppingCart_id, product_id, quantity) values (2, 20, 6);
insert into CartDetail (shoppingCart_id, product_id, quantity) values (3, 7, 10);
insert into CartDetail (shoppingCart_id, product_id, quantity) values (4, 19, 1);
insert into CartDetail (shoppingCart_id, product_id, quantity) values (5, 11, 7);
insert into CartDetail (shoppingCart_id, product_id, quantity) values (1, 5, 4);
insert into CartDetail (shoppingCart_id, product_id, quantity) values (2, 14, 3);
insert into CartDetail (shoppingCart_id, product_id, quantity) values (3, 2, 6);
insert into CartDetail (shoppingCart_id, product_id, quantity) values (4, 15, 3);
insert into CartDetail (shoppingCart_id, product_id, quantity) values (5, 18, 5);


insert into User_PaymentMethod (user_id, paymentMethod_id) values (10, 63);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (8, 41);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (10, 56);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (10, 77);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (10, 91);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (10, 24);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (10, 55);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (9, 38);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (9, 95);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (10, 58);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (10, 62);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (6, 74);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (9, 59);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (10, 45);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (10, 39);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (10, 64);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (10, 69);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (6, 51);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (6, 77);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (7, 81);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (8, 54);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (10, 76);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (10, 2);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (10, 7);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (9, 24);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (7, 22);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (6, 79);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (7, 5);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (9, 56);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (10, 60);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (7, 30);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (6, 45);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (10, 3);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (9, 11);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (8, 73);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (10, 16);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (8, 9);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (10, 14);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (9, 41);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (8, 31);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (10, 42);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (6, 75);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (10, 57);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (10, 44);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (7, 69);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (8, 1);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (7, 49);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (9, 54);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (6, 52);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (9, 23);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (7, 95);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (7, 10);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (10, 18);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (7, 64);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (10, 53);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (8, 45);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (8, 78);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (6, 23);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (8, 62);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (7, 19);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (10, 10);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (10, 4);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (9, 50);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (10, 49);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (10, 89);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (9, 29);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (7, 77);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (9, 83);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (8, 91);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (9, 4);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (10, 70);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (10, 71);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (9, 99);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (6, 1);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (8, 20);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (8, 72);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (10, 59);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (10, 26);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (10, 52);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (8, 76);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (10, 86);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (9, 90);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (10, 15);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (7, 70);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (10, 50);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (9, 39);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (10, 43);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (10, 75);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (10, 17);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (9, 70);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (9, 3);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (10, 20);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (7, 16);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (8, 21);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (6, 50);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (10, 19);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (8, 64);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (10, 82);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (10, 80);
insert into User_PaymentMethod (user_id, paymentMethod_id) values (10, 5);


insert into Notification ("date", user_id, is_read, notify_id, notify_type) values ('2023-02-27 19:48:10', 9, 1, 1, 'App\Models\Notifications\PurchaseNotification');
insert into Notification ("date", user_id, is_read, notify_id, notify_type) values ('2023-06-12 23:05:38', 6, 1, 2, 'App\Models\Notifications\PurchaseNotification');
insert into Notification ("date", user_id, is_read, notify_id, notify_type) values ('2023-05-07 02:22:09', 9, 0, 3, 'App\Models\Notifications\PurchaseNotification');
insert into Notification ("date", user_id, is_read, notify_id, notify_type) values ('2023-01-08 18:13:41', 6, 0, 4, 'App\Models\Notifications\PurchaseNotification');
insert into Notification ("date", user_id, is_read, notify_id, notify_type) values ('2023-08-25 14:14:50', 6, 0, 5, 'App\Models\Notifications\PurchaseNotification');
insert into Notification ("date", user_id, is_read, notify_id, notify_type) values ('2023-06-29 09:50:55', 8, 0, 6, 'App\Models\Notifications\PurchaseNotification');
insert into Notification ("date", user_id, is_read, notify_id, notify_type) values ('2022-10-27 17:38:44', 7, 0, 7, 'App\Models\Notifications\PurchaseNotification');
insert into Notification ("date", user_id, is_read, notify_id, notify_type) values ('2023-06-29 16:17:35', 7, 0, 8, 'App\Models\Notifications\PurchaseNotification');
insert into Notification ("date", user_id, is_read, notify_id, notify_type) values ('2023-07-11 07:56:50', 8, 0, 1, 'App\Models\Notifications\ProductNotification');
insert into Notification ("date", user_id, is_read, notify_id, notify_type) values ('2023-06-14 08:05:59', 9, 0, 2, 'App\Models\Notifications\ProductNotification');
insert into Notification ("date", user_id, is_read, notify_id, notify_type) values ('2022-11-15 21:09:25', 6, 0, 3, 'App\Models\Notifications\ProductNotification');
insert into Notification ("date", user_id, is_read, notify_id, notify_type) values ('2022-10-25 20:14:50', 9, 0, 4, 'App\Models\Notifications\ProductNotification');
insert into Notification ("date", user_id, is_read, notify_id, notify_type) values ('2023-03-22 19:50:55', 8, 0, 5, 'App\Models\Notifications\ProductNotification');
insert into Notification ("date", user_id, is_read, notify_id, notify_type) values ('2023-06-16 23:12:42', 7, 0, 1, 'App\Models\Notifications\WishListNotification');
insert into Notification ("date", user_id, is_read, notify_id, notify_type) values ('2023-01-11 03:42:46', 9, 0, 2, 'App\Models\Notifications\WishListNotification');
insert into Notification ("date", user_id, is_read, notify_id, notify_type) values ('2022-11-25 03:40:23', 6, 0, 3, 'App\Models\Notifications\WishListNotification');
insert into Notification ("date", user_id, is_read, notify_id, notify_type) values ('2023-03-27 10:46:15', 9, 0, 1, 'App\Models\Notifications\CartNotification');


insert into PurchaseNotification (purchase_id, body) values (1, 'Purchase Complete');
insert into PurchaseNotification (purchase_id, body) values (2, 'Purchase Complete');
insert into PurchaseNotification (purchase_id, body) values (3, 'Purchase Complete');
insert into PurchaseNotification (purchase_id, body) values (4, 'Purchase Complete');
insert into PurchaseNotification (purchase_id, body) values (5, 'Purchase Complete');
insert into PurchaseNotification (purchase_id, body) values (6, 'Purchase Complete');
insert into PurchaseNotification (purchase_id, body) values (7, 'Purchase Complete');
insert into PurchaseNotification (purchase_id, body) values (8, 'Purchase Complete');


insert into ProductNotification (product_id, body) values (6, 'Change in the order processing stage');
insert into ProductNotification (product_id, body) values (4, 'Change in the order processing stage');
insert into ProductNotification (product_id, body) values (4, 'Change in the order processing stage');
insert into ProductNotification (product_id, body) values (5, 'Change in the order processing stage');
insert into ProductNotification (product_id, body) values (1, 'Change in the order processing stage');


insert into WishListNotification (wishlist_id, body) values (6, 'Product in the wishlist now available');
insert into WishListNotification (wishlist_id, body) values (7, 'Product in the wishlist now available');
insert into WishListNotification (wishlist_id, body) values (9, 'Product in the wishlist now available');

insert into ShoppingCartNotification (shoppingCart_id, body) values (1, 'Product in the Shopping Cart has changed it''s price');

insert into UserStories (number, name, priority, description)
values
    ('US01', 'See Home', 'High', 'As a User, I want to access the home page, so that I can see a brief presentation of the website.'),
    ('US02', 'See About', 'High', 'As a User, I want to access the about page, so that I can see a complete description of the website and its creators.'),
    ('US03', 'Search Product', 'High', 'As a User, I want to use exact match search, so that I can find products by their exact name.'),
    ('US04', 'Consult Contacts', 'High', 'As a User, I want to access contact information, so that I can get in touch with the platform creators.'),
    ('US05', 'Search', 'High', 'As a User, I want to use full-text search, so that I can find products related to what I entered in the search bar.'),
    ('US06', 'Filter', 'High', 'As a User, I want to use filters and categories, so that I can narrow down my search results.'),
    ('US07', 'Product List', 'High', 'As a User, I want to view the product list, so that I can see all available products.'),
    ('US08', 'Consult Product', 'High', 'As a User, I want to view the product details, so that I have more information about the products.'),
    ('US09', 'Consult Reviews', 'High', 'As a User, I want to view the product reviews, so that I can see what other users think of the product.'),
    ('US10', 'Check Features', 'High', 'As a User, I want to access the main features page, so that I can see the most important features of the website.'),
    ('US11', 'Consult FAQ', 'Medium', 'As a User, I want to access the FAQ, so that I can get quick answers to common questions.'),
    ('US12', 'Sort', 'Medium', 'As a User, I want to order results, so that I can see results in my preferred order.'),
    ('US21', 'Recover Password', 'High', 'As an Authenticated user, I want to have an option to recover my password, so that I can access my account if I forget or lose the old password.'),
    ('US22', 'Delete Account', 'High', 'As an Authenticated user, I want to have an option to delete my account, so that I do not have an account anymore.'),
    ('US24', 'Stay Notified', 'High', 'As an Authenticated user, I want to view my personal notifications, so that I can keep track of what I have been notified on.'),
    ('US25', 'Add To Shopping Cart', 'High', 'As an Authenticated user, I want to add products to the shopping cart, so that I can see the collective price and buy everything at once.'),
    ('US26', 'Manage Shopping Cart', 'High', 'As an Authenticated user, I want to manage the shopping cart, so that I can remove products, view the product details, and adjust product quantities.'),
    ('US27', 'Purchase History', 'High', 'As an Authenticated user, I want to view my purchase history, so that I can see what products I have bought.'),
    ('US28', 'Add To Wishlist', 'High', 'As an Authenticated user, I want to add products to the favorites list, so that I can save products and not have to look for them again.'),
    ('US29', 'Manage Wishlist', 'High', 'As an Authenticated user, I want to manage the favorites list, so that I can remove products and view the product details.'),
    ('US30', 'Review Products', 'High', 'As an Authenticated user, I want to review products, so that I can share my opinion on the products I have bought.'),
    ('US31', 'Consult Reviews', 'High', 'As an Authenticated user, I want to view the checkout, so that I can see the details and total cost of my purchase.'),
    ('US32', 'Edit My Reviews', 'High', 'As an Authenticated user, I want to edit my reviews, so that I can change what I wrote if I feel like something in the review needs to change.'),
    ('US33', 'Delete My Reviews', 'High', 'As an Authenticated user, I want to remove my reviews, so that I can delete my comment if I do not want to keep it.'),
    ('US34', 'Track My Orders', 'High', 'As an Authenticated user, I want to track my orders, so that I can see at what stage of the delivery process the products are.'),
    ('US35', 'Cancel My Orders', 'High', 'As an Authenticated user, I want to cancel my orders, so that I can no longer have the product delivered.'),
    ('US36', 'Payment Notification', 'High', 'As an Authenticated user, I want to receive a "payment approved" notification, so that I can know when my payment is approved.'),
    ('US37', 'Processing Stage Notification', 'High', 'As an Authenticated user, I want to receive a "change in order processing stage" notification, so that I can be informed when the product changes its order processing state.'),
    ('US38', 'Product Available Notification', 'High', 'As an Authenticated user, I want to receive a "product in favorites available" notification, so that I can stay informed about their availability.'),
    ('US39', 'Price Change Notification', 'High', 'As an Authenticated user, I want to receive a "product in cart price change" notification, so that I can stay informed about the price changes for products in my shopping cart.'),
    ('US42', 'Manage Payment Methods', 'Medium', 'As an Authenticated user, I want to manage multiple payment methods, so that I can choose which payment method to use.'),
    ('US51', 'Login', 'High', 'As an Unauthenticated user, I want to authenticate into the system, so that I can access privileged information.'),
    ('US52', 'Register', 'High', 'As an Unauthenticated user, I want to register myself into the system, so that I can authenticate myself into the system.'),
    ('US53', 'Logout', 'High', 'As an Authenticated user, I want to logout, so that I can end my session in the website.'),
    ('US61', 'Search Users', 'High', 'As an Administrator, I want to search for user accounts, so that I can access the account information.'),
    ('US62', 'Edit Users', 'High', 'As an Administrator, I want to edit user accounts, so that I can alter account information.'),
    ('US63', 'Create Users', 'High', 'As an Administrator, I want to create new accounts, so that I can evaluate the websites’ functionalities.'),
    ('US64', 'Unban Users', 'High', 'As an Administrator, I want to unban user accounts, so that those users can access privileged information again.'),
    ('US65', 'Delete Users', 'High', 'As an Administrator, I want to delete user accounts, so that I can completely disallow a user from accessing privileged information.'),
    ('US66', 'Ban Users', 'High', 'As an Administrator, I want to ban a user from the system, so that they can no longer access its privileged information.'),
    ('US67', 'Add Products', 'High', 'As an Administrator, I want to add products to the shop, so that I can put new products up for sale.'),
    ('US68', 'Manage Stock', 'High', 'As an Administrator, I want to manage the product stock, so that I can edit the number of products available for purchase.'),
    ('US69', 'Manage Categories', 'High', 'As an Administrator, I want to manage product categories, so that I can create, delete, or edit filter categories.'),
    ('US70', 'View Users’ Purchase History', 'High', 'As an Administrator, I want to view users purchase history, so that I can have information about what they have bought.'),
    ('US71', 'Manage Orders’ Status', 'High', 'As an Administrator, I want to manage the order status, so that I can provide users with information about the status of their order.'),
    ('US72', 'Edit Product', 'Medium', 'As an Administrator, I want to manage product information, so that I can edit details for each product.');

insert into FAQ (question, answer) values
    ('Is there a return policy?', 'Yes, we have a 30-day return policy for most items. Please contact us for more details.'),
    ('How can I track my order?', 'After your order is dispatched, you''ll receive a tracking number via email. You can use this number to track your package on our website.'),
    ('Are there any shipping fees?', 'Shipping fees may vary depending on the location and weight of the items. We offer free shipping on orders above $50.'),
    ('What payment methods are accepted?', 'We accept major credit cards (Visa, Mastercard, American Express) and PayPal as payment methods.'),
    ('How do I contact customer support?', 'You can reach our customer support team at support@petopiastore.com or by calling +123456789.');
