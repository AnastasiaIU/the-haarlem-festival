SET NAMES utf8mb4;

CREATE TABLE event
(
    id                    INT AUTO_INCREMENT PRIMARY KEY,
    slug                  VARCHAR(100) NOT NULL UNIQUE,
    menu_name             VARCHAR(100) NOT NULL,
    hero_title            VARCHAR(100),
    hero_subtitle         VARCHAR(100),
    hero_description      VARCHAR(2000),
    title                 VARCHAR(100),
    subtitle              VARCHAR(100),
    home_page_title       VARCHAR(100),
    home_page_description VARCHAR(2000),
    image                 VARCHAR(100),
    shape                 VARCHAR(100)
);

INSERT INTO event (slug, menu_name, hero_title, hero_subtitle, hero_description, title, subtitle, home_page_title,
                   home_page_description, image, shape)
VALUES ('', 'Home', 'You really don’t want to miss this!', NULL,
        'Explore Haarlem like never before! Discover top events, music, food, and history during The Festival – four unforgettable days of excitement in the heart of the city!',
        NULL, NULL, NULL, NULL, 'banner.png', NULL),
       ('dance', 'DANCE!', 'DANCE!', 'Dance to the Rhythm of Haarlem Festival',
        'Feel the energy, embrace the beats, and lose yourself in the music. The dance stage at Haarlem Festival brings the city to life with electrifying performances by world-renowned DJs and rising stars. From hypnotic techno rhythms to pulsating beats across genres, this is where music lovers unite under one roof. Prepare for an unforgettable journey through sound, light, and movement.<br>Let the music move you. Let the festival inspire you.',
        'ARTISTS', 'Explore the artists', 'JOIN THE DANCE!',
        'Feel the energy, embrace the beats, and lose yourself in the music. The dance stage at Haarlem Festival brings the city to life with electrifying performances by world-renowned DJs and rising stars. From hypnotic techno rhythms to pulsating beats across genres, this is where music lovers unite under one roof. Prepare for an unforgettable journey through sound, light, and movement.<br>Let the music move you. Let the festival inspire you.',
        'dance.png', 'dance_shape.svg'),
       ('yummy', 'Yummy!', 'Yummy!', 'What is it about?',
        'Indulge your taste buds at Yummy!, the ultimate food lover’s event at The Festival. Experience the city’s vibrant culinary scene as Haarlem’s top restaurants come together to offer <b><em>exclusive festival menus at irresistible prices</em></b>. From modern twists on Dutch classics to global flavors, there’s something to delight every palate.<br>This four-day event isn’t just about food—it’s a celebration of Haarlem’s creativity, culture, and hospitality. Explore unique dining experiences, enjoy expertly crafted dishes, and meet the chefs behind the creations. Imagine savoring a creamy cheese croquette, a perfectly spiced satay, or a warm stroopwafel fresh from the iron - Yummy!<br>Perfect for foodies, families, and anyone looking to savor the best of Haarlem’s gastronomy, this event promises an unforgettable culinary journey. Come hungry and leave inspired!',
        'PARTICIPANTS', 'Explore the restaurants', 'EXPLORE THE YUMMY!',
        'Indulge your taste buds at Yummy!, the ultimate food lover’s event at The Festival. Experience the city’s vibrant culinary scene as Haarlem’s top restaurants come together to offer <b><em>exclusive festival menus at irresistible prices</em></b>. From modern twists on Dutch classics to global flavors, there’s something to delight every palate.<br>This four-day event isn’t just about food—it’s a celebration of Haarlem’s creativity, culture, and hospitality. Explore unique dining experiences, enjoy expertly crafted dishes, and meet the chefs behind the creations. Imagine savoring a creamy cheese croquette, a perfectly spiced satay, or a warm stroopwafel fresh from the iron - Yummy!<br>Perfect for foodies, families, and anyone looking to savor the best of Haarlem’s gastronomy, this event promises an unforgettable culinary journey. Come hungry and leave inspired!',
        'yummy.png', 'yummy_shape.svg'),
       ('strolls', 'History Strolls', 'A Stroll through History', 'What is it about?',
        'Discover the rich and fascinating history of Haarlem on an immersive guided walking tour. Join us as we explore some of the city’s most historic and significant landmarks, uncovering stories and events that have shaped Haarlem throughout the centuries. This engaging 2.5-hour tour includes a 15-minute break where you can relax and enjoy refreshments.<br>The walking tours will take place every Thursday, Friday, and Saturday, with multiple departures available each day to suit your schedule. Starting near the iconic Church of St. Bavo on the bustling Grote Markt, you’ll easily spot our starting point thanks to a large flag marking the location.<br>Led by knowledgeable guides, this tour is perfect for history enthusiasts, curious travelers, and anyone looking to gain a deeper understanding of Haarlem’s unique heritage. Whether you’re a local or a visitor, this tour promises to bring Haarlem’s history to life in an unforgettable way. Join us and take a step back in time!',
        'EXPLORE TOUR LOCATIONS', NULL, 'FIND OUT ABOUT THE HAARLEM HISTORY',
        'A Stroll Through History invites visitors to explore Haarlem’s rich and fascinating past through a guided walking tour of its most historic sites. Over the course of 2.5 hours, participants will visit iconic landmarks such as the Church of St. Bavo, Grote Markt, Molen de Adriaan, and Amsterdamse Poort. With a knowledgeable guide leading the way, you’ll uncover the stories behind these treasured locations and gain a deeper appreciation for Haarlem’s unique blend of history and culture. A 15-minute break at the charming Jopenkerk allows for refreshments and a moment to take in the surroundings.<br>This immersive experience is ideal for history enthusiasts and curious travelers alike. Each participant receives a digital souvenir as a keepsake of their journey, adding a modern touch to this historical adventure. With multiple departure times and small group sizes, "A Stroll Through History" ensures a personalized and engaging experience that brings Haarlem’s storied past to life.',
        'history_strolls.png', 'history_strolls_shape.svg'),
       ('teylers', 'Magic@Teylers', 'VISIT THE  TEYLER’S MUSEUM', NULL,
        'The Teyler’s Museum is the oldest museum in the Netherlands. The building opened its doors to the public in 1784. Teylers’ nickname is "Museum of Wonder", a name that fits well. Here you marvel at a unique collection of art, science and history. There is work by the greatest artists and scientists of recent centuries. From Rembrandt and Michelangelo to Newton and Copernicus. A highlight is the neoclassical Oval Room. Here you can view a large collection of fossils and minerals. Did you know that the complete interior of this hall has remained intact since its opening in the 18th century? Unique for a Dutch museum.',
        NULL, NULL, 'VISIT THE  TEYLER’S MUSEUM',
        'The Teyler’s Museum is the oldest museum in the Netherlands. The building opened its doors to the public in 1784. Teylers’ nickname is "Museum of Wonder", a name that fits well. Here you marvel at a unique collection of art, science and history. There is work by the greatest artists and scientists of recent centuries. From Rembrandt and Michelangelo to Newton and Copernicus. A highlight is the neoclassical Oval Room. Here you can view a large collection of fossils and minerals. Did you know that the complete interior of this hall has remained intact since its opening in the 18th century? Unique for a Dutch museum.',
        'teylers.png', 'teylers_shape.svg');

CREATE TABLE artist
(
    id               INT AUTO_INCREMENT PRIMARY KEY,
    event_id         INT           NOT NULL,
    slug             VARCHAR(100)  NOT NULL UNIQUE,
    stage_name       VARCHAR(100)  NOT NULL,
    genre            VARCHAR(100)  NOT NULL,
    hero_description VARCHAR(2000) NOT NULL,
    card_description VARCHAR(2000) NOT NULL,
    image            VARCHAR(100)  NOT NULL,
    card_image       VARCHAR(100)  NOT NULL,
    carousel_image1  VARCHAR(100)  NOT NULL,
    carousel_image2  VARCHAR(100)  NOT NULL,
    carousel_image3  VARCHAR(100)  NOT NULL,
    carousel_image4  VARCHAR(100)  NOT NULL,
    carousel_image5  VARCHAR(100)  NOT NULL,
    carousel_image6  VARCHAR(100)  NOT NULL,
    CONSTRAINT fk_event_id_artist FOREIGN KEY (event_id) REFERENCES event (id)
);

INSERT INTO artist (event_id, slug, stage_name, genre, hero_description, card_description, image, card_image,
                    carousel_image1, carousel_image2, carousel_image3, carousel_image4, carousel_image5,
                    carousel_image6)
VALUES (2, 'hardwell', 'Hardwell', 'Dance and House',
        'Hardwell, a globally renowned Dutch DJ and music producer, rose to fame with his electrifying performances and chart-topping tracks in the electronic dance music (EDM) scene. He gained international recognition with his 2011 hit "Zero 76" alongside Tiësto and was crowned the world’s No. 1 DJ by DJ Mag in 2013 and 2014. Known for his high-energy sets at festivals like Tomorrowland and Ultra Music Festival, Hardwell has also founded the Revealed Recordings label, nurturing new talent in the EDM industry. After a brief hiatus from touring in 2018, he made a triumphant return in 2022 with a new album, "Rebels Never Die", solidifying his legacy as a pioneer in progressive and big room house music.',
        'A global phenomenon in electronic dance music, Hardwell is a powerhouse DJ and producer known for his high-energy performances and chart-topping hits. Hailing from the Netherlands, he has headlined the world’s biggest festivals and consistently pushes the boundaries of progressive and big room house. Prepare for an unforgettable set that will ignite the dance floor!',
        'hardwell_hero.png', 'hardwell_card.png', 'hardwell_carousel1.png', 'hardwell_carousel2.png',
        'hardwell_carousel3.png', 'hardwell_carousel4.png', 'hardwell_carousel5.png', 'hardwell_carousel6.png'),
       (2, 'armin-van-buuren', 'Armin van Buuren', 'Trance and Techno',
        'Armin van Buuren is one of the most influential figures in the trance and electronic music scene. As a five-time DJ Mag No. 1 DJ, he has defined and pushed the boundaries of trance music for over two decades. Known for iconic tracks like "This Is What It Feels Like" and his globally renowned "A State of Trance" radio show, he has played an essential role in bringing trance music to a worldwide audience. His electrifying performances at festivals such as Tomorrowland, Ultra Music Festival, and EDC showcase his ability to captivate crowds with euphoric melodies and seamless mixes.',
        'A true legend in the trance music scene, Armin van Buuren has captivated audiences worldwide with his euphoric melodies and dynamic sets. As a five-time #1 DJ in the world, his passion for music and connection with fans create an electrifying atmosphere. Get ready to be transported on a musical journey you’ll never forget!',
        'armin_van_buuren_hero.png', 'armin_van_buuren_card.png', 'armin_van_buuren_carousel1.png',
        'armin_van_buuren_carousel2.png', 'armin_van_buuren_carousel3.png', 'armin_van_buuren_carousel4.png',
        'armin_van_buuren_carousel5.png', 'armin_van_buuren_carousel6.png'),
       (2, 'martin-garrix', 'Martin Garrix', 'Dance and Electronic',
        'Martin Garrix, a Dutch DJ and producer, skyrocketed to fame with his 2013 hit single "Animals", which became a global anthem in the EDM scene. Renowned for his infectious melodies and energetic performances, he has headlined major festivals such as Tomorrowland, Ultra Music Festival, and Coachella. Named the world’s No. 1 DJ by DJ Mag multiple times since 2016, Garrix is also the founder of the STMPD RCRDS label, supporting emerging talent in electronic music. Collaborating with top artists like Dua Lipa and Bebe Rexha, he continues to push boundaries, solidifying his place as one of the most influential figures in modern dance music.',
        'A superstar in the EDM world, Martin Garrix is renowned for his infectious energy and global hits like Animals and Scared to Be Lonely. With his genre-defying sound and electrifying performances, he’s a festival favorite who knows how to get the crowd moving. Expect a set full of surprises and unforgettable moments!',
        'martin_garrix_hero.png', 'martin_garrix_card.png', 'martin_garrix_carousel1.png',
        'martin_garrix_carousel2.png', 'martin_garrix_carousel3.png', 'martin_garrix_carousel4.png',
        'martin_garrix_carousel5.png', 'martin_garrix_carousel6.png'),
       (2, 'tiesto', 'Tiësto', 'Trance, Techno, Minimal, House, and Electronic',
        'Tiësto is a legendary Dutch DJ and music producer who has shaped the global electronic dance music scene. With a career spanning over two decades, he is known for iconic tracks like "Adagio for Strings", "Red Lights", and "Jackie Chan". A former No. 1 DJ in the world, Tiësto has evolved from trance to house and techno while consistently remaining a festival favorite. He has performed at major global events, including the Olympics and major festivals like Tomorrowland and Ultra Music Festival, continuing to redefine electronic music with his innovative sound.',
        'A pioneer in electronic dance music, Tiësto is a name that resonates with fans across the globe. From his trance roots to his chart-topping anthems, he’s a master of creating unforgettable moments on the dance floor. Brace yourself for a high-energy set from one of the greatest DJs of all time!',
        'tiesto_hero.png', 'tiesto_card.png', 'tiesto_carousel1.png', 'tiesto_carousel2.png', 'tiesto_carousel3.png',
        'tiesto_carousel4.png', 'tiesto_carousel5.png', 'tiesto_carousel6.png'),
       (2, 'nicky-romero', 'Nicky Romero', 'Electro House and Progressive House',
        'Nicky Romero is a Dutch DJ, record producer, and label owner best known for his signature electro and progressive house sound. Rising to international fame with hits like "Toulouse" and his collaboration with Avicii, "I Could Be The One", he has become a key figure in electronic dance music. As the founder of Protocol Recordings, he has helped shape the careers of upcoming producers. Nicky Romero continues to perform at top festivals worldwide and remains an influential force in the dance music industry.',
        'A trailblazer in progressive and electro house, Nicky Romero is known for his powerful beats and iconic tracks like Toulouse and I Could Be the One. His ability to blend emotion with energy makes his performances a must-see. Get ready for a set that will keep you dancing from start to finish!',
        'nicky_romero_hero.png', 'nicky_romero_card.png', 'nicky_romero_carousel1.png', 'nicky_romero_carousel2.png',
        'nicky_romero_carousel3.png', 'nicky_romero_carousel4.png', 'nicky_romero_carousel5.png',
        'nicky_romero_carousel6.png'),
       (2, 'afrojack', 'Afrojack', 'House',
        'Afrojack, a Grammy Award-winning Dutch DJ and producer, is one of the most influential figures in electronic dance music. Known for his energetic performances and massive hits like "Take Over Control" and "Ten Feet Tall", he has collaborated with some of the biggest names in the industry, including David Guetta, Beyoncé, and Pitbull. Afrojack’s unique sound, blending electro house and big room elements, has made him a festival mainstay at events like Tomorrowland and Ultra Music Festival. As the founder of Wall Recordings, he continues to support and develop new talent in the EDM scene.',
        'A dynamic force in the EDM scene, Afrojack is celebrated for his electrifying performances and globally acclaimed hits like Take Over Control and Hey Mama. Known for blending house, hip-hop, and pop influences, he brings unmatched energy to every stage. Prepare for a show that will leave you exhilarated!',
        'afrojack_hero.png', 'afrojack_card.png', 'afrojack_carousel1.png', 'afrojack_carousel2.png',
        'afrojack_carousel3.png', 'afrojack_carousel4.png', 'afrojack_carousel5.png', 'afrojack_carousel6.png');


CREATE TABLE restaurant
(
    id               INT AUTO_INCREMENT PRIMARY KEY,
    event_id         INT           NOT NULL,
    slug             VARCHAR(100)  NOT NULL UNIQUE,
    name             VARCHAR(100)  NOT NULL,
    address          VARCHAR(150)  NOT NULL,
    stars            INT           NOT NULL CHECK (stars BETWEEN 1 AND 5),
    michelin         ENUM ('Nominated', '1 Star') DEFAULT NULL,
    description      VARCHAR(2000) NOT NULL,
    card_description VARCHAR(2000) NOT NULL,
    capacity         INT           NOT NULL,
    full_price       DECIMAL(7, 2) NOT NULL,
    adult_price      DECIMAL(7, 2) NOT NULL,
    kids_price       DECIMAL(7, 2) NOT NULL,
    duration         INT           NOT NULL,
    sessions         INT           NOT NULL,
    first_session    TIME          NOT NULL,
    menu             VARCHAR(100)  NOT NULL,
    phone            VARCHAR(50)   NOT NULL,
    email            VARCHAR(255)  NOT NULL,
    start_date       DATE          NOT NULL,
    end_date         DATE          NOT NULL,
    carousel_image1  VARCHAR(100)  NOT NULL,
    carousel_image2  VARCHAR(100)  NOT NULL,
    carousel_image3  VARCHAR(100)  NOT NULL,
    carousel_image4  VARCHAR(100)  NOT NULL,
    carousel_image5  VARCHAR(100)  NOT NULL,
    carousel_image6  VARCHAR(100)  NOT NULL,
    image            VARCHAR(100)  NOT NULL,
    CONSTRAINT fk_event_id_restaurant FOREIGN KEY (event_id) REFERENCES event (id)
);

INSERT INTO restaurant (event_id, slug, name, address, stars, michelin, description, card_description, capacity,
                        full_price, adult_price, kids_price, duration, sessions, first_session, menu, phone, email,
                        start_date, end_date, carousel_image1, carousel_image2, carousel_image3, carousel_image4,
                        carousel_image5, carousel_image6, image)
VALUES (3, 'ratatouille', 'Ratatouille Food and Wine', 'Spaarne 96, 2011 CL Haarlem', 4, '1 Star',
        'At Ratatouille, we embrace the art of sophisticated flavors and create a gastronomic experience beyond expectations. Our restaurant, led by passionate chef Jozua Jaring, has established itself as a culinary haven in Haarlem, where every meal is a celebration of taste and style.<br>Our menus reflect the diversity of flavors and textures, with each dish carefully crafted to offer a harmonious culinary adventure. Whether you are enjoying an intimate dinner, a business lunch or celebrating a special occasion, our menu promises a gastronomic experience beyond your expectations.<br>We invite you to experience Ratatouille Food and Wine and discover the magic of gourmet excellence. Whether you are a local foodie or visiting Haarlem, we welcome you to our restaurant where passion for food and wine comes alive.<br>Immerse yourself in the world of Ratatouille and let us indulge your senses. Welcome to a culinary adventure like no other!<br><br>With gourmet greetings,<br>The team of Ratatouille Food and Wine, Haarlem',
        'Welcome to Ratatouille Food and Wine, where gastronomy becomes an art and hospitality is at the heart of our experience. Located in the heart of Haarlem, our restaurant led by the inspired chef Jozua Jaring is a haven for lovers of refined flavors and stylish culinary adventures.',
        52, 99.00, 45.00, 22.50, 120, 3, '17:00:00', 'menu_ratatouille.png', '023 542 7270',
        'info@ratatouillefoodandwine.nl', '2025-07-24', '2025-07-27', 'ratatouille_carousel1.png',
        'ratatouille_carousel2.png', 'ratatouille_carousel3.png', 'ratatouille_carousel4.png',
        'ratatouille_carousel5.png', 'ratatouille_carousel6.png', 'ratatouille.png'),
       (3, 'ml', 'Restaurant ML', 'Klokhuisplein 5, 2011 HK Haarlem', 4, '1 Star',
        'Restaurant ML offers a refined dining experience in a historic setting on Klokhuisplein in Haarlem. Led by Chef Mark Gratama, ML delivers an exceptional culinary journey, combining contemporary flavors with high-quality ingredients. Located in a national monument, the restaurant’s ambiance is both elegant and welcoming, making it an ideal spot for an intimate dinner or special celebration. Enjoy a carefully curated menu featuring bold flavors, complemented by a sophisticated wine selection.',
        'Restaurant ML is located in the heart of the charming national monument on Klokhuisplein. The restaurant is situated in the courtyard of the former printer Johan Enschedé and in the old drawing room of the former residence of the Enschedé family. Chef Mark Gratama’s elegant cuisine is bold with exciting flavor combinations.',
        60, 95.00, 45.00, 22.50, 120, 2, '17:00:00', 'menu_ml.png', '023 512 3910', 'welkom@mlinhaarlem.nl',
        '2025-07-24', '2025-07-27', 'ml_carousel1.png', 'ml_carousel2.png', 'ml_carousel3.png', 'ml_carousel4.png',
        'ml_carousel5.png', 'ml_carousel6.png', 'ml.png'),
       (3, 'fris', 'Fris', 'Twijnderslaan 7, 2012 BG Haarlem', 4, 'Nominated',
        'Welcome to Restaurant Fris, a culinary gem located in the heart of Haarlem.<br><br>Our award-winning restaurant is known for exquisite dishes that are both innovative and delicious to the taste buds. Chef Eddie Meijboom creates dishes with the freshest, locally produced ingredients, combining the best of Dutch cuisine with international flavors. Maître Julius Wever will be happy to guide you in choosing the right wine to accompany your meal.<br><br>The atmosphere at Fris is warm and inviting, with a sleek and modern interior that provides the perfect setting for a romantic dinner, celebratory meal with friends or business lunch. Come by and be surprised by our unique French cuisine with Asian influences.<br><br>We look forward to welcoming you to our restaurant.',
        'This award-winning restaurant is known for exquisite dishes that are both innovative and delicious to the taste buds. Chef Eddie Meijboom creates dishes with the freshest, locally produced ingredients, combining the best of Dutch cuisine with international flavors. Maître Julius Wever will be happy to guide you in choosing the right wine to accompany your meal.',
        45, 70.00, 45.00, 22.50, 90, 3, '17:30:00', 'menu_fris.png', '023 531 0717', 'info@restaurantfris.nl',
        '2025-07-24', '2025-07-27', 'fris_carousel1.png', 'fris_carousel2.png', 'fris_carousel3.png',
        'fris_carousel4.png', 'fris_carousel5.png', 'fris_carousel6.png', 'fris.png'),
       (3, 'cafe-de-roemer', 'Café de Roemer', 'Botermarkt 17, 2011 XL Haarlem', 4, NULL,
        'Café de Roemer is a beloved meeting place in Haarlem, known for its relaxed atmosphere and high-quality dishes. Whether you’re stopping by for a casual lunch, an indulgent dinner, or just drinks with friends, Café de Roemer offers a menu full of delicious options. Using fresh, locally sourced ingredients, the kitchen creates flavorful dishes inspired by classic European cuisine. The café’s warm and inviting setting makes it a perfect spot to unwind and enjoy great food in the heart of Haarlem.',
        'Welcome to Café de Roemer, an iconic spot located on the Botermarkt in the heart of Haarlem. A household name in Haarlem for over 30 years and now owned by two enthusiastic entrepreneurs who continue the Roemer heritage with new energy.',
        35, 46.00, 35.00, 17.50, 90, 3, '18:00:00', 'menu_cafe_de_roemer.png', '023 532 5267', 'info@cafederoemer.nl',
        '2025-07-24', '2025-07-27', 'cafe-de-roemer_carousel1.png', 'cafe-de-roemer_carousel2.png',
        'cafe-de-roemer_carousel3.png', 'cafe-de-roemer_carousel4.png', 'cafe-de-roemer_carousel5.png',
        'cafe-de-roemer_carousel6.png', 'cafe-de-roemer.png'),
       (3, 'restaurant-toujours', 'Restaurant Toujours', 'Oude Groenmarkt 10-12, 2011 HL Haarlem', 3, NULL,
        'Restaurant Toujours is a modern bistro in Haarlem, where classic French cuisine meets a contemporary twist. Known for its stylish interior and lively atmosphere, Toujours offers a dynamic menu featuring high-quality seafood, premium meats, and delicious vegetarian options. Whether you’re indulging in a gourmet burger, fresh oysters, or a perfectly grilled steak, each dish is crafted with precision and passion. The restaurant’s extensive cocktail and wine selection further enhances the dining experience.',
        'Discover Restaurant Toujours, a culinary oasis in the heart of Haarlem, where every dinner tells a story of luxury and refinement. Located in the heart of the city, Toujours offers a dining experience that embodies the essence of Haarlem’s rich gastronomic culture.',
        48, 45.00, 35.00, 17.50, 90, 3, '17:30:00', 'menu_restaurant_toujours.png', '023 532 1699',
        'info@restauranttoujours.nl', '2025-07-24', '2025-07-27', 'toujours_carousel1.png', 'toujours_carousel2.png',
        'toujours_carousel3.png', 'toujours_carousel4.png', 'toujours_carousel5.png', 'toujours_carousel6.png',
        'restaurant-toujours.png'),
       (3, 'new-vegas', 'New Vegas', 'Koningstraat 5, 2011 TB Haarlem', 3, NULL,
        'New Vegas is Haarlem’s first fully vegan restaurant, offering a fresh and innovative take on plant-based dining. Designed to make vegan food approachable and exciting for everyone, New Vegas serves delicious, recognizable dishes crafted with high-quality, locally sourced ingredients. From hearty burgers to creative small plates, each meal is designed to satisfy both dedicated vegans and those curious about plant-based cuisine. With its welcoming ambiance and commitment to sustainability, New Vegas is redefining vegan dining in Haarlem.',
        'The first vegan restaurant in Haarlem that lowers the threshold to plant-based cuisine. Delicious and recognizable dishes for everyone! They call themselves: The Veganizers.',
        36, 40.00, 35.00, 17.50, 90, 3, '17:00:00', 'menu_new_vegas.png', '06 19 78 70 43', 'info@new-vegas.nl',
        '2025-07-24', '2025-07-27', 'new-vegas_carousel1.png', 'new-vegas_carousel2.png', 'new-vegas_carousel3.png',
        'new-vegas_carousel4.png', 'new-vegas_carousel5.png', 'new-vegas_carousel6.png', 'new-vegas.png'),
       (3, 'grand-cafe-brinkmann', 'Grand Café Brinkmann', 'Grote Markt 13, 2011 RC Haarlem', 3, NULL,
        'Grand Café Brinkmann is a Haarlem institution, known for its historic charm and lively ambiance. Located on the Grote Markt, this grand café has been a favorite spot for locals and visitors alike for decades. Whether you’re looking for a leisurely breakfast, a satisfying lunch, or a cozy dinner, Brinkmann offers a diverse menu catering to all tastes. Enjoy a range of classic Dutch and European dishes, as well as an extensive selection of drinks, while taking in the beautiful surroundings of Haarlem’s main square.',
        'Grand Café Brinkmann is a historic gem located in the heart of Haarlem, offering a perfect blend of classic charm and modern cuisine. Known for its cozy atmosphere and diverse menu, it’s an ideal spot to enjoy a delicious meal or a refreshing drink while soaking in the vibrant city life.',
        100, 38.50, 35.00, 17.50, 90, 3, '16:30:00', 'menu_grand_cafe_brinkmann.png', '023 532 3111',
        'info@grandcafebrinkmann.nl', '2025-07-24', '2025-07-27', 'brinkmann_carousel1.png', 'brinkmann_carousel2.png',
        'brinkmann_carousel3.png', 'brinkmann_carousel4.png', 'brinkmann_carousel5.png', 'brinkmann_carousel6.png',
        'grand-cafe-brinkmann.png');


CREATE TABLE chef
(
    id            INT AUTO_INCREMENT PRIMARY KEY,
    restaurant_id INT          NOT NULL,
    name          VARCHAR(100) NOT NULL,
    image         VARCHAR(100) NOT NULL,
    description   VARCHAR(500) NOT NULL,
    CONSTRAINT fk_restaurant_id_chef FOREIGN KEY (restaurant_id) REFERENCES restaurant (id)
);

INSERT INTO chef (restaurant_id, name, image, description)
VALUES (1, 'Joshua Jaring', 'chef_joshua_jaring.png',
        'With more than 10 years of experience as a chef and owner of Ratatouille Food and Wine, Chef Joshua Jaring has not only perfected the art of cooking, but also created a unique place where gourmet creativity and craftsmanship come together. His dedication to innovation and use of high-quality ingredients make every meal at Ratatouille an unforgettable experience.'),
       (2, 'Mark Gratama', 'chef_mark_gratama.png',
        'Chef Mark Gratama’s style stands out with his broad palette of flavors. His cuisine is playful, pushing the boundaries between tradition and innovation. Balance is a requirement for him, but he always seeks excitement. His thoughtful combinations showcase his respect for the rich French cuisine and the inspiration he finds in challenging techniques from the modern, international kitchen.'),
       (3, 'Eddie Meijboom', 'chef_eddie_meijboom.png',
        'Haarlem-born Chef Eddie Meijboom leads the kitchen at Fris with creativity and precision. His philosophy is simple: fewer ingredients, more flavour. Drawing from his experience at Michelin-starred restaurants like Cheval Blanc and La Rive, Eddie crafts dishes rooted in French technique but elevated with Asian and Scandinavian influences. Every plate is a tribute to honest ingredients and bold taste.');


CREATE TABLE food_type
(
    id         INT AUTO_INCREMENT PRIMARY KEY,
    name       VARCHAR(100) NOT NULL,
    icon       VARCHAR(100) NOT NULL,
    bg_color   VARCHAR(6)   NOT NULL,
    text_color VARCHAR(6)   NOT NULL
);

INSERT INTO food_type (name, icon, bg_color, text_color)
VALUES ('Dutch', 'dutch_flag.svg', 'CDE7FF', '41479B'),
       ('French', 'french_flag.svg', '87C1F8', '41479B'),
       ('European', 'eu_flag.svg', 'F1D556', '41479B'),
       ('Fish and Seafood', 'fish_and_seafood_icon.svg', 'B8D6F2', '205DC3'),
       ('Vegan', 'vegan_icon.svg', 'A4E0D9', '005C52');


CREATE TABLE served_food
(
    restaurant_id INT NOT NULL,
    food_id       INT NOT NULL,
    CONSTRAINT fk_restaurant_id_served_food FOREIGN KEY (restaurant_id) REFERENCES restaurant (id),
    CONSTRAINT fk_food_id FOREIGN KEY (food_id) REFERENCES food_type (id)
);

INSERT INTO served_food (restaurant_id, food_id)
VALUES (1, 2),
       (1, 3),
       (1, 4),
       (2, 1),
       (2, 3),
       (2, 4),
       (3, 1),
       (3, 2),
       (3, 3),
       (4, 1),
       (4, 3),
       (4, 4),
       (5, 1),
       (5, 3),
       (5, 4),
       (6, 5),
       (7, 1),
       (7, 3);


CREATE TABLE language
(
    id       INT AUTO_INCREMENT PRIMARY KEY,
    language VARCHAR(100) NOT NULL
);

INSERT INTO language (language)
VALUES ('Chinese'),
       ('Dutch'),
       ('English');


CREATE TABLE guide
(
    id          INT AUTO_INCREMENT PRIMARY KEY,
    language_id INT          NOT NULL,
    name        VARCHAR(100) NOT NULL,
    description VARCHAR(500) NOT NULL,
    image       VARCHAR(100) NOT NULL,
    CONSTRAINT fk_language_id_guide FOREIGN KEY (language_id) REFERENCES language (id)
);

INSERT INTO guide (language_id, name, description, image)
VALUES (2, 'Jan-Willem',
        'Jan-Willem is an experienced guide with seven years in the field, known for his warm demeanor and captivating narratives that bring history and nature to life for curious travelers.',
        'guide_jan-willem.png'),
       (3, 'Frederic',
        'Frederick is a charismatic guide with five years of experience, blending historical knowledge and engaging stories to create unforgettable journeys through vibrant cities and serene landscapes for diverse travelers.',
        'guide_frederic.png'),
       (2, 'Annet',
        'Annet is an enthusiastic new guide with one year of experience, combining her fresh perspective and friendly demeanor to create engaging and memorable journeys for travelers exploring new destinations.',
        'guide_annet.png'),
       (3, 'Williams',
        'Williams is a dedicated new guide with one year of experience, offering enthusiastic and personalized tours that make every destination come alive for travelers seeking unique and memorable experiences.',
        'guide_williams.png'),
       (1, 'Kim',
        'Kim is a vibrant guide focusing on Chinese culture and history, blending her fresh knowledge with a natural curiosity to craft deeply immersive and authentic experiences for her travelers.',
        'guide_kim.png'),
       (2, 'Lisa',
        'Lisa is a dedicated guide specializing in Dutch-language tours, known for her warm personality and skillful storytelling, creating enriching and memorable experiences that connect travelers to history and culture.',
        'guide_lisa.png'),
       (3, 'Deirdre',
        'Deidre is an experienced guide specializing in English-language tours, offering travelers thoughtful insights and engaging stories that bring history, culture, and local traditions to life in unforgettable ways.',
        'guide_deirdre.png'),
       (1, 'Susan',
        'Susan is a passionate guide specializing in Chinese-language tours, known for her engaging storytelling and friendly approach, making history and culture come alive for travelers of all backgrounds.',
        'guide_susan.png');


CREATE TABLE tour_type
(
    id           INT AUTO_INCREMENT PRIMARY KEY,
    capacity     INT           NOT NULL,
    single_price DECIMAL(7, 2) NOT NULL,
    family_price DECIMAL(7, 2) NOT NULL
);

INSERT INTO tour_type (capacity, single_price, family_price)
VALUES (12, 17.50, 60.00);


CREATE TABLE tour
(
    id        INT AUTO_INCREMENT PRIMARY KEY,
    guide_id  INT      NOT NULL,
    tour_id   INT      NOT NULL,
    date_time DATETIME NOT NULL,
    CONSTRAINT fk_guide_id_tour FOREIGN KEY (guide_id) REFERENCES guide (id),
    CONSTRAINT fk_tour_id_tour_type FOREIGN KEY (tour_id) REFERENCES tour_type (id)
);

INSERT INTO tour (guide_id, tour_id, date_time)
VALUES (1, 1, '2025-07-24 10:00:00'),
       (1, 1, '2025-07-24 13:00:00'),
       (1, 1, '2025-07-24 16:00:00'),
       (2, 1, '2025-07-24 10:00:00'),
       (2, 1, '2025-07-24 13:00:00'),
       (2, 1, '2025-07-24 16:00:00'),
       (3, 1, '2025-07-25 10:00:00'),
       (3, 1, '2025-07-25 13:00:00'),
       (3, 1, '2025-07-25 16:00:00'),
       (4, 1, '2025-07-25 10:00:00'),
       (4, 1, '2025-07-25 13:00:00'),
       (4, 1, '2025-07-25 16:00:00'),
       (5, 1, '2025-07-25 13:00:00'),
       (3, 1, '2025-07-26 10:00:00'),
       (3, 1, '2025-07-26 13:00:00'),
       (3, 1, '2025-07-26 16:00:00'),
       (1, 1, '2025-07-26 10:00:00'),
       (1, 1, '2025-07-26 13:00:00'),
       (2, 1, '2025-07-26 10:00:00'),
       (2, 1, '2025-07-26 13:00:00'),
       (2, 1, '2025-07-26 16:00:00'),
       (4, 1, '2025-07-26 10:00:00'),
       (4, 1, '2025-07-26 13:00:00'),
       (5, 1, '2025-07-26 13:00:00'),
       (5, 1, '2025-07-26 16:00:00'),
       (6, 1, '2025-07-27 10:00:00'),
       (6, 1, '2025-07-27 13:00:00'),
       (6, 1, '2025-07-27 16:00:00'),
       (3, 1, '2025-07-27 10:00:00'),
       (3, 1, '2025-07-27 13:00:00'),
       (1, 1, '2025-07-27 13:00:00'),
       (7, 1, '2025-07-27 10:00:00'),
       (7, 1, '2025-07-27 13:00:00'),
       (7, 1, '2025-07-27 16:00:00'),
       (2, 1, '2025-07-27 10:00:00'),
       (2, 1, '2025-07-27 13:00:00'),
       (4, 1, '2025-07-27 13:00:00'),
       (8, 1, '2025-07-27 10:00:00'),
       (8, 1, '2025-07-27 13:00:00'),
       (5, 1, '2025-07-27 13:00:00');


CREATE TABLE location
(
    id               INT AUTO_INCREMENT PRIMARY KEY,
    event_id         INT           NOT NULL,
    slug             VARCHAR(100)  NOT NULL UNIQUE,
    name             VARCHAR(100)  NOT NULL,
    address          VARCHAR(150)  NOT NULL,
    description      VARCHAR(2000) NOT NULL,
    card_description VARCHAR(2000) NOT NULL,
    image            VARCHAR(100)  NOT NULL,
    card_image       VARCHAR(100)  NOT NULL,
    carousel_image1  VARCHAR(100)  NOT NULL,
    carousel_image2  VARCHAR(100)  NOT NULL,
    carousel_image3  VARCHAR(100)  NOT NULL,
    carousel_image4  VARCHAR(100)  NOT NULL,
    carousel_image5  VARCHAR(100)  NOT NULL,
    carousel_image6  VARCHAR(100)  NOT NULL,
    CONSTRAINT fk_event_id_location FOREIGN KEY (event_id) REFERENCES event (id)
);

INSERT INTO location (event_id, slug, name, address, description, card_description, image, card_image, carousel_image1,
                      carousel_image2, carousel_image3, carousel_image4, carousel_image5, carousel_image6)
VALUES (4, 'church-of-st-bavo', 'Church of St. Bavo', 'Grote Markt 22, 2011 RD Haarlem',
        'The Church of St. Bavo is centrally located in Haarlem, a city in the Netherlands, situated on the bustling Grote Markt (Main Square). Surrounded by charming cobblestone streets, the church is easily accessible and serves as a prominent landmark in the heart of the city.<br>The immediate vicinity of the church is characterized by vibrant activity, with markets, shops, cafes, and restaurants lining the square. The area also features other notable architectural landmarks, adding to the historical and cultural richness of the setting. The church’s towering spire is visible from various points in Haarlem, serving as a guidepost for visitors navigating the city.<br>Its location in the Grote Markt makes it a hub of local activity, often hosting events, gatherings, and performances that utilize the open square and the church’s magnificent acoustics. The nearby streets offer a mix of modern and traditional Dutch influences, creating a picturesque setting that enhances the church’s visual prominence.',
        'Welcome to St. Bavo’s Cathedral, a masterpiece of Gothic architecture and a symbol of Haarlem’s rich history and culture. Situated in the heart of the city, this iconic landmark invites visitors to marvel at its grandeur, from its soaring spires to the renowned Müller organ that has inspired musicians for centuries. St. Bavo’s is not just a cathedral but a place where history, art, and spirituality come together to create an unforgettable experience.',
        'church_of_st_bavo.png', 'card_church-of-st-bavo.png', 'church-of-st-bavo_carousel1.png',
        'church-of-st-bavo_carousel2.png', 'church-of-st-bavo_carousel3.png', 'church-of-st-bavo_carousel4.png',
        'church-of-st-bavo_carousel5.png', 'church-of-st-bavo_carousel6.png'),
       (4, 'grote-markt', 'Grote Markt', 'Grote Markt, 2011 RD Haarlem',
        'The Grote Markt is the central square of Haarlem, serving as the historical and cultural heart of the city. Surrounded by stunning medieval architecture, the square is home to some of Haarlem’s most significant landmarks, including the Church of St. Bavo and the City Hall. <br>Throughout the week, the Grote Markt is a lively gathering place where visitors and locals alike enjoy open-air markets, festivals, and live performances. The surrounding cafes and restaurants provide ample seating to take in the bustling atmosphere while savoring traditional Dutch delicacies. Whether exploring by day or night, the Grote Markt embodies the charm and vibrancy of Haarlem’s rich heritage.',
        'The Grote Markt is the vibrant heart of Haarlem, where history, culture, and community converge. Surrounded by stunning architecture and filled with life, this iconic square invites you to explore its historic landmarks, relax in its charming cafés, and soak in the lively atmosphere. A perfect blend of tradition and modern energy, the Grote Markt captures the essence of Haarlem like no other.',
        'grote_markt.png', 'card_grote-markt.png', 'grote-markt_carousel1.png', 'grote-markt_carousel2.png',
        'grote-markt_carousel3.png', 'grote-markt_carousel4.png', 'grote-markt_carousel5.png',
        'grote-markt_carousel6.png'),
       (4, 'de-hallen', 'De Hallen', 'Grote Markt 16, 2011 RD Haarlem',
        'De Hallen, located on the historic Grote Markt, is one of Haarlem’s premier cultural centers. Originally built as a marketplace, this stunning building now houses the Frans Hals Museum’s contemporary art collection and serves as an exhibition space for modern and historical artworks.<br>The building itself is a masterpiece of Dutch architecture, blending historic charm with modern design elements. Inside, visitors can explore rotating exhibitions featuring both established and emerging artists. With its prime location in Haarlem’s bustling center, De Hallen is a must-visit for art lovers and those interested in the city’s creative spirit.',
        'De Hallen Haarlem is a cultural gem in the heart of the city, blending contemporary art with history. Housed in a historic building, it features inspiring exhibitions from Dutch and international artists. With its fusion of heritage and innovation, it’s a must-visit for art lovers. A true destination for culture enthusiasts.',
        'de_hallen.png', 'card_de-hallen.png', 'de-hallen_carousel1.png', 'de-hallen_carousel2.png',
        'de-hallen_carousel3.png', 'de-hallen_carousel4.png', 'de-hallen_carousel5.png', 'de-hallen_carousel6.png'),
       (4, 'proveniershof', 'Proveniershof', 'Grote Houtstraat 142D, 2011 SV Haarlem',
        'The Proveniershof is a picturesque courtyard garden located in the heart of Haarlem. This serene enclave is surrounded by charming, modest houses built in a traditional Dutch style. The hofje, or courtyard, is enclosed by a low wall and features a single entrance gate, offering a sense of tranquility and seclusion from the bustling streets of the city.<br>The garden at the center of the Proveniershof is meticulously maintained, with lush greenery, seasonal flowers, and neatly trimmed hedges. Pathways meander through the courtyard, leading visitors to admire the harmonious layout of the space. The houses around the courtyard are built with uniformity, characterized by their gabled facades, shuttered windows, and brick construction. The overall aesthetic exudes a timeless, peaceful charm.<br>The Proveniershof is a quintessential example of Dutch hofjes, offering a glimpse into the architectural and design sensibilities of past centuries while providing a restful retreat in the middle of the city.',
        'The Proveniershof is a hidden gem in Haarlem, where history, tranquility, and charm converge. Surrounded by picturesque architecture and lush greenery, this serene courtyard invites you to explore its peaceful pathways, admire its historic beauty, and escape the bustle of the city. A perfect blend of tradition and calm, the Proveniershof captures the essence of Haarlem’s timeless allure.',
        'proveniershof.png', 'card_proveniershof.png', 'proveniershof_carousel1.png', 'proveniershof_carousel2.png',
        'proveniershof_carousel3.png', 'proveniershof_carousel4.png', 'proveniershof_carousel5.png',
        'proveniershof_carousel6.png'),
       (4, 'jopenkerk', 'Jopenkerk', 'Gedempte Voldersgracht 2, 2011 WD Haarlem',
        'Jopenkerk is a unique brewery housed in a beautifully restored former church in Haarlem. This remarkable venue combines history with modern craft brewing, offering visitors an unforgettable experience in a stunning setting.<br>Inside, towering brewing kettles stand alongside stained-glass windows, creating a striking blend of tradition and innovation. Jopenkerk produces a variety of specialty beers inspired by historical Haarlem recipes, which can be enjoyed fresh from the tap. The lively atmosphere, combined with expertly crafted beers and delicious food pairings, makes Jopenkerk a favorite destination for both beer enthusiasts and casual visitors.',
        'The Jopenkerk is a unique landmark in Haarlem, where history, craft, and community converge. Housed in a beautifully restored church, this iconic brewery invites you to savor its award-winning beers, admire its stunning architecture, and enjoy the vibrant atmosphere. A perfect blend of tradition and modern creativity, the Jopenkerk captures the spirit of Haarlem like no other.',
        'jopenkerk.png', 'card_jopenkerk.png', 'jopenkerk_carousel1.png', 'jopenkerk_carousel2.png',
        'jopenkerk_carousel3.png', 'jopenkerk_carousel4.png', 'jopenkerk_carousel5.png', 'jopenkerk_carousel6.png'),
       (4, 'waalse-kerk-haarlem', 'Waalse Kerk Haarlem', 'Begijnhof 28, 2011 HE Haarlem',
        'Waalse Kerk Haarlem is a hidden gem nestled in the city’s historic Begijnhof. Originally built in the 14th century, this beautifully preserved church has long been a place of worship and cultural significance.<br>The church is known for its elegant simplicity, with stunning stained-glass windows, wooden pews, and a serene ambience that invites quiet reflection. Today, Waalse Kerk serves as both a religious space and a venue for intimate concerts and performances, thanks to its excellent acoustics. Its rich history and tranquil atmosphere make it a unique stop for those exploring Haarlem’s architectural and cultural heritage.',
        'The first cultural venue in Haarlem that lowers the threshold to art, history, and creativity. A place where inspiring events, concerts, and exhibitions come together in a unique and historic setting, making culture accessible and enjoyable for everyone. They call themselves: The Heritage Makers.',
        'waalse-kerk-haarlem.png', 'card_waalse-kerk-haarlem.png', 'waalse-kerk-haarlem_carousel1.png',
        'waalse-kerk-haarlem_carousel2.png', 'waalse-kerk-haarlem_carousel3.png', 'waalse-kerk-haarlem_carousel4.png',
        'waalse-kerk-haarlem_carousel5.png', 'waalse-kerk-haarlem_carousel6.png'),
       (4, 'molen-de-adriaan', 'Molen de Adriaan', 'Papentorenvest 1A, 2011 AV Haarlem',
        'Molen de Adriaan is one of Haarlem’s most iconic landmarks, standing proudly along the banks of the Spaarne River. This traditional Dutch windmill, originally built in 1779, has been lovingly restored to its former glory and now operates as a museum.<br>Visitors can take guided tours to learn about the mill’s fascinating history, its role in Haarlem’s industrial past, and the mechanics behind wind-powered production. The panoramic views from the top of the windmill offer breathtaking sights of Haarlem’s skyline, making it a favorite destination for history lovers and photography enthusiasts alike.',
        'This iconic windmill is renowned for its rich history and stunning views, offering a unique experience that blends tradition with modern charm. The millers at Molen de Adriaan preserve the craft of milling, using centuries-old techniques to create flour of the highest quality. Whether you’re exploring the interactive exhibits or enjoying a guided tour, the passionate staff will ensure an unforgettable visit, immersing you in the fascinating world of Dutch heritage.',
        'molen-de-adriaan.png', 'card_molen-de-adriaan.png', 'molen-de-adriaan_carousel1.png',
        'molen-de-adriaan_carousel2.png', 'molen-de-adriaan_carousel3.png', 'molen-de-adriaan_carousel4.png',
        'molen-de-adriaan_carousel5.png', 'molen-de-adriaan_carousel6.png'),
       (4, 'amsterdamse-poort', 'Amsterdamse Poort', '2011 BZ Haarlem',
        'The Amsterdamse Poort is the last remaining city gate of Haarlem, a striking medieval structure that once served as a crucial entrance to the city. Built in the early 15th century, this historic landmark is a stunning example of Gothic architecture, complete with turrets, archways, and intricate brickwork.<br>Walking through the gate, visitors can imagine Haarlem’s rich history as a fortified city. Today, Amsterdamse Poort stands as a testament to the city’s past while providing a picturesque backdrop for photos and leisurely walks along the scenic surrounding streets.',
        'Welcome to Amsterdamse Poort, a historic gateway located at the entrance to Haarlem, offering a glimpse into the city’s rich past. As one of the most iconic landmarks in Haarlem, the Amsterdamse Poort has stood for centuries, marking the original entrance to the city. Today, this impressive structure continues to captivate visitors, blending history with the vibrant energy of modern Haarlem.',
        'amsterdamse-poort.png', 'card_amsterdamse-poort.png', 'amsterdamse-poort_carousel1.png',
        'amsterdamse-poort_carousel2.png', 'amsterdamse-poort_carousel3.png', 'amsterdamse-poort_carousel4.png',
        'amsterdamse-poort_carousel5.png', 'amsterdamse-poort_carousel6.png'),
       (4, 'hof-van-bakenes', 'Hof van Bakenes', 'Korte Begijnestraat 18, 2011 HC Haarlem',
        'Hof van Bakenes is one of Haarlem’s oldest and most charming hofjes (courtyard gardens), dating back to the late 14th century. This hidden oasis is tucked away in the bustling city center, offering a peaceful escape from the lively streets.<br>With its carefully maintained garden, historic cottages, and tranquil atmosphere, Hof van Bakenes provides visitors with a glimpse into Haarlem’s unique hofje tradition. The entrance is discreet, making it feel like a secret retreat, perfect for those looking to experience a moment of serenity in the heart of the city.',
        'Welcome to Hof van Bakenes, a charming courtyard tucked away in the heart of Haarlem, offering a peaceful retreat with a touch of history. As one of the city’s hidden gems, Hof van Bakenes dates back to the 14th century and has long been a symbol of Haarlem’s rich heritage. Today, this serene spot remains a beautiful reminder of the past, blending historical significance with the tranquil ambiance of modern-day Haarlem.',
        'hof-van-bakenes.png', 'card_hof-van-bakenes.png', 'hof-van-bakenes_carousel1.png',
        'hof-van-bakenes_carousel2.png', 'hof-van-bakenes_carousel3.png', 'hof-van-bakenes_carousel4.png',
        'hof-van-bakenes_carousel5.png', 'hof-van-bakenes_carousel6.png');


CREATE TABLE title
(
    id    INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL
);

INSERT INTO title (title)
VALUES ('History'),
       ('Relevance to Haarlem'),
       ('Function in Haarlem Today');


CREATE TABLE description
(
    id            INT AUTO_INCREMENT PRIMARY KEY,
    location_id   INT           NOT NULL,
    title_id      INT           NOT NULL,
    description   VARCHAR(2000) NOT NULL,
    display_order INT           NOT NULL,
    CONSTRAINT fk_location_id_description FOREIGN KEY (location_id) REFERENCES location (id),
    CONSTRAINT fk_title_id FOREIGN KEY (title_id) REFERENCES title (id)
);

INSERT INTO description (location_id, title_id, description, display_order)
VALUES (1, 1,
        'The Church of St. Bavo, also known as the Grote Kerk, has a rich history that dates back to the 14th and 15th centuries when its construction began. Initially built as a Catholic cathedral, the church transitioned to Protestant worship following the Reformation in the 16th century. This shift reflects the broader religious and social changes occurring in the Netherlands during this period.<br>Over the centuries, the church has undergone various renovations and additions, blending Gothic and later Renaissance styles. The towering central spire, completed in the 16th century, became a defining feature of Haarlem’s skyline. Despite the challenges of time and changing political climates, the church has remained a centerpiece of Haarlem’s religious and cultural life.',
        1),
       (1, 2,
        '<p>Cultural Significance:</p><ul><li>The Church of St. Bavo is one of Haarlem’s most iconic landmarks, symbolizing the city’s rich artistic and architectural heritage.</li><li>It serves as a venue for concerts, including performances on its world-famous Müller organ, which has drawn musicians and audiences from around the globe.</li></ul><p>Historical Importance:</p><ul><li>The church has witnessed key events in Haarlem’s history, from religious transformations to periods of economic prosperity and decline.</li><li>It houses the tombs of prominent figures such as Frans Hals, a master of the Dutch Golden Age, making it a focal point for art and history enthusiasts.</li></ul><p>Tourism and Education:</p><ul><li>As a major tourist attraction, the church draws visitors eager to explore its stunning architecture, historical significance, and artistic treasures.</li><li>It offers educational opportunities, showcasing Haarlem’s history and the evolution of religious and civic life in the Netherlands.</li></ul>',
        2),
       (1, 3,
        '<p>Religious Role:</p><ul><li>Though no longer a Catholic cathedral, the Church of St. Bavo remains an active place of worship, hosting services and religious ceremonies.</li><li>It represents the city’s Protestant heritage while welcoming people of all backgrounds.</li></ul><p>Community and Civic Functions:</p><ul><li>The church is a hub for local events, including markets, exhibitions, and festivals, strengthening its role as a gathering place for the community.</li><li>Its prominent location in the Grote Markt makes it a centerpiece for civic pride and activity.</li></ul><p>Art and Music:</p><ul><li>The Müller organ continues to be a highlight of Haarlem’s cultural offerings, with regular recitals and international acclaim.</li><li>Art enthusiasts appreciate the church’s collection of paintings, sculptures, and historical artifacts that reflect Haarlem’s artistic legacy.</li></ul>',
        3),
       (2, 1,
        'The Grote Markt has been at the center of Haarlem’s history for centuries, serving as a hub for trade, governance, and public gatherings. It has witnessed significant events, from medieval fairs to political revolutions, reflecting the city’s evolution over time.<br>The square has long been the site of markets where merchants, artisans, and farmers sold their goods. Over the centuries, it has also hosted public celebrations, military parades, and civic ceremonies, making it a focal point for Haarlem’s social and economic life.',
        1),
       (2, 2,
        '<p>Architectural Landmarks:</p><ul><li>The Grote Markt is home to some of Haarlem’s most significant historical buildings, including the Church of St. Bavo and the City Hall.</li><li>Surrounding the square are beautifully preserved medieval and Renaissance-style buildings that reflect the city’s architectural heritage.</li></ul><p>Community and Social Hub:</p><ul><li>The square remains a vibrant gathering place, hosting markets, festivals, and public performances throughout the year.</li><li>It serves as an essential meeting point for both locals and visitors, offering a lively mix of history and modern-day activity.</li></ul>',
        2),
       (2, 3,
        '<p>Tourism and Experience:</p><ul><li>Visitors to Haarlem often begin their journey at the Grote Markt, taking in its historic charm and bustling atmosphere.</li><li>The surrounding cafes and restaurants provide a perfect setting to enjoy the view and experience Haarlem’s rich cultural scene.</li></ul><p>Events and Festivals:</p><ul><li>The square regularly hosts seasonal markets, music festivals, and cultural events, making it a dynamic and engaging destination.</li><li>Its central location ensures easy access to Haarlem’s other major attractions, making it an ideal starting point for exploring the city.</li></ul>',
        3),
       (3, 1,
        'De Hallen has a rich history as part of Haarlem’s medieval trade and commerce network. Originally constructed as a marketplace, this historic building played a central role in the city’s economic life, providing a space for merchants to sell their goods.<br>Over the centuries, De Hallen has undergone several transformations, adapting to the needs of Haarlem’s evolving community. Today, it has been repurposed as a cultural hub while retaining its historical significance.',
        1),
       (3, 2,
        '<p>Architectural Heritage:</p><ul><li>De Hallen showcases a blend of medieval and modern architectural elements, with carefully restored facades that reflect Haarlem’s past.</li><li>The structure’s interior has been adapted to house cultural and artistic exhibitions while maintaining its historical charm.</li></ul><p>Cultural Importance:</p><ul><li>As part of the Frans Hals Museum, De Hallen serves as an important center for contemporary and historical art.</li> <li>It provides a platform for both established and emerging artists, contributing to Haarlem’s reputation as a cultural hotspot.</li></ul>',
        2),
       (3, 3,
        '<p>Exhibitions and Events:</p><ul><li>Visitors can explore a rotating collection of art exhibitions, featuring works that span different eras and styles.</li><li>De Hallen regularly hosts lectures, workshops, and cultural events that engage both locals and tourists.</li></ul><p>Accessibility and Atmosphere:</p><ul><li>Located on the Grote Markt, De Hallen is easily accessible and surrounded by cafes, shops, and other attractions.</li><li>Its dynamic mix of art, history, and modern culture makes it a must-visit destination for those looking to experience Haarlem’s artistic legacy.</li></ul>',
        3),
       (4, 1,
        'The Proveniershof has its origins in the tradition of hofjes, small courtyards surrounded by housing, which were common in the Netherlands from the Middle Ages onward. Originally built as a place for older men known as "proveniers", who could buy the right to live there in exchange for a fee or inheritance, it was designed to provide shelter and community for those who could no longer support themselves independently.<br>The Proveniershof, like many other hofjes, was constructed to reflect the principles of charity and community that were deeply embedded in Dutch society. Over the centuries, it has been carefully preserved, with the architecture and layout largely remaining faithful to its historical roots, offering a glimpse into life in earlier times.',
        1),
       (4, 2,
        '<p>Architectural Heritage:</p><ul><li>The Proveniershof is a prime example of Haarlem’s rich tradition of hofjes, showcasing the unique blend of functionality and aesthetic charm typical of these courtyards.</li><li>It contributes to the city’s historical and cultural landscape, attracting visitors who appreciate Haarlem’s architectural legacy.</li></ul><p>Cultural Significance:</p><ul><li>The Proveniershof is emblematic of the philanthropic spirit that shaped many Dutch cities during the medieval and Renaissance periods.</li><li>It serves as a reminder of Haarlem’s focus on community-oriented living, making it a valuable part of the city’s identity.</li></ul><p>Tourism Appeal:</p><ul><li>The peaceful beauty of the Proveniershof makes it a favorite destination for tourists exploring Haarlem’s lesser-known historical sites.</li><li>It offers an intimate experience of traditional Dutch living, distinct from the busier, more famous landmarks in the city.</li></ul>',
        2),
       (4, 3,
        '<p>Residential Use:</p><ul><li>Like many hofjes, the Proveniershof continues to function as a residential space, offering housing primarily for elderly residents or those seeking a quiet and communal living environment.</li><li>The sense of privacy and tranquility remains a hallmark of its design.</li></ul><p>Historical Preservation:</p><ul><li>The Proveniershof is maintained as a protected historical site, ensuring that its buildings and gardens retain their authentic character.</li><li>It is a living testament to Haarlem’s architectural and social history, blending functionality with cultural preservation.</li></ul><p>Tourist and Community Space:</p><ul><li>While it remains primarily a residential area, the Proveniershof welcomes visitors during specific times, allowing them to experience its serene beauty and historical significance.</li><li>Its central location makes it an accessible and cherished part of Haarlem’s cityscape, offering both locals and tourists a tranquil escape from urban life.</li></ul>',
        3),
       (5, 1,
        'Jopenkerk’s origins date back to the early days of Haarlem’s brewing tradition, with records of beer production in the city stretching back to the Middle Ages. Haarlem was once a major brewing center in the Netherlands, and Jopen, a revival of this heritage, brings historic recipes back to life.<br>The brewery itself is housed in a former church, a unique setting that combines historical architecture with modern brewing techniques. The transformation from a place of worship to a craft brewery has made Jopenkerk one of Haarlem’s most distinctive landmarks.',
        1),
       (5, 2,
        '<p>Craft Brewing Excellence:</p><ul><li>Jopenkerk is renowned for its high-quality craft beers, inspired by historical Haarlem brewing traditions.</li><li>The brewery produces a range of beers, from classic Dutch styles to experimental brews, offering something for every beer enthusiast.</li></ul><p>Architectural and Cultural Blend:</p><ul><li>The fusion of old and new is evident in Jopenkerk’s interior, where stained-glass windows and brewing kettles stand side by side.</li><li>It has become a popular destination for both beer lovers and those interested in the adaptive reuse of historic buildings.</li></ul>',
        2),
       (5, 3,
        '<p>A Must-Visit for Beer Lovers:</p><ul><li>Jopenkerk offers guided tours that showcase its brewing process and the fascinating history behind Haarlem’s beer-making legacy.</li><li>Visitors can enjoy tastings, pairing experiences, and exclusive seasonal brews that reflect both tradition and innovation.</li></ul> <p>Community and Atmosphere:</p><ul><li>The brewery serves as a lively social space, attracting both locals and tourists who come to enjoy its welcoming atmosphere.</li><li>With a restaurant and bar inside, Jopenkerk provides the perfect setting to savor a craft beer in a historic yet contemporary environment.</li></ul>',
        3),
       (6, 1,
        'The Waalse Kerk Haarlem, or Walloon Church, has been a part of the city’s religious and cultural landscape since the 14th century. Originally built as a Catholic place of worship, it later became a Protestant church following the Reformation.<br>This transition reflects the broader religious shifts in the Netherlands, and today, the Waalse Kerk continues to serve as a vibrant center of faith and culture.',
        1),
       (6, 2,
        '<p>Historical Architecture:</p><ul><li>The church’s structure features stunning medieval brickwork, wooden beams, and elegant stained-glass windows.</li><li>Its modest yet beautifully designed interior provides an intimate atmosphere that distinguishes it from Haarlem’s grander churches.</li></ul><p>Cultural and Musical Significance:</p><ul><li>The Waalse Kerk is known for its exceptional acoustics, making it a favored venue for classical concerts and choral performances.</li><li>It has hosted many notable musicians and continues to be an important location for cultural events in Haarlem.</li></ul>',
        2),
       (6, 3,
        '<p>Religious and Community Use:</p><ul><li>Though smaller than other churches in Haarlem, the Waalse Kerk remains an active place of worship, holding services in both Dutch and French.</li><li>It is a welcoming space for both regular congregants and visitors interested in its historical significance.</li></ul><p>Concerts and Events:</p><ul><li>The church frequently opens its doors for music lovers, with concerts ranging from organ recitals to chamber music performances.</li><li>Its central location in the Begijnhof provides a peaceful retreat from the busier parts of Haarlem, making it a hidden gem worth exploring.</li></ul>',
        3),
       (7, 1,
        'Molen de Adriaan has stood as a defining feature of Haarlem’s skyline since its original construction in 1779. Used for various industrial purposes over the years, the windmill played an essential role in the city’s economy and trade.<br>Though the original mill was destroyed by fire in 1932, it was faithfully reconstructed in the early 2000s. Today, it stands as a tribute to Haarlem’s dedication to preserving its historical landmarks.',
        1),
       (7, 2,
        '<p>Engineering Marvel:</p><ul><li>Molen de Adriaan is a classic example of Dutch windmill engineering, demonstrating the ingenuity behind these structures.</li><li>Its mechanisms, once used for grinding grain and other industrial processes, are now part of an interactive educational experience.</li></ul><p>Symbol of Haarlem:</p><ul><li>With its prominent location along the Spaarne River, the windmill serves as a recognizable symbol of the city’s heritage.</li><li>The site is one of the most photographed attractions in Haarlem, drawing visitors eager to learn about the Netherlands’ windmill tradition.</li></ul>',
        2),
       (7, 3,
        '<p>Interactive and Educational:</p><ul><li>Guided tours allow visitors to see the inner workings of the windmill, explaining its mechanics and history.</li><li>Interactive exhibits provide a deeper understanding of how windmills contributed to Dutch industry.</li></ul><p>Scenic Views:</p><ul><li>The windmill offers spectacular views over the Spaarne River and Haarlem’s historic center.</li><li>It is a favorite spot for photographers and history enthusiasts alike, combining culture, engineering, and natural beauty.</li></ul>',
        3),
       (8, 1,
        'The Amsterdamse Poort is the last remaining city gate of Haarlem, originally constructed in the 14th century as part of the city’s medieval defenses. Once serving as a key entrance for travelers and traders coming from Amsterdam, it stood as a testament to Haarlem’s strategic importance.<br>Over the centuries, the gate has witnessed Haarlem’s transformation from a fortified town to a thriving cultural and economic center.',
        1),
       (8, 2,
        '<p>Medieval Architecture:</p><ul><li>The gate showcases traditional Gothic architectural elements, with turrets, red-brick walls, and arched passageways.</li><li>It remains remarkably well-preserved, offering insight into the city’s fortification techniques during the Middle Ages.</li></ul><p>Connection to Haarlem’s History:</p><ul><li>The Amsterdamse Poort stands as a reminder of Haarlem’s medieval past and the city’s role in Dutch trade and defense.</li><li>Its location at the eastern edge of the city makes it a significant historical landmark that continues to captivate visitors.</li></ul>',
        2),
       (8, 3,
        '<p>Tourist Attraction:</p><ul><li>The gate remains a popular stop for tourists exploring Haarlem’s rich historical sites.</li><li>Visitors can walk through the structure, admire its intricate details, and imagine the city’s medieval past.</li></ul><p>Scenic Surroundings:</p><ul><li>Located near picturesque canals and bridges, Amsterdamse Poort is a great place for a leisurely stroll or a scenic photography session.</li><li>The surrounding area has charming cafes and local shops, offering a perfect blend of history and modern-day Haarlem life.</li></ul>',
        3),
       (9, 1,
        'Hof van Bakenes is one of Haarlem’s oldest hofjes, dating back to the late 14th century. These courtyard residences were originally built to provide housing for elderly women in need, reflecting the city’s long-standing tradition of social welfare.<br>The hofje has been carefully maintained over the centuries, preserving its original layout and tranquil ambiance while continuing to serve as a residential retreat.',
        1),
       (9, 2,
        '<p>Architectural Beauty:</p><ul><li>The Hof van Bakenes features traditional Dutch hofje architecture, with red-brick facades, shuttered windows, and a central garden.</li><li>Its design emphasizes simplicity and harmony, creating a peaceful retreat amidst Haarlem’s bustling city streets.</li></ul><p>Symbol of Haarlem’s Philanthropy:</p><ul><li>Hofjes like this one were built as acts of charity, reflecting Haarlem’s commitment to community support and social housing.</li><li>The carefully preserved buildings offer a rare glimpse into how Haarlem’s elderly residents once lived in these sheltered courtyards.</li></ul>',
        2),
       (9, 3,
        '<p>A Hidden Gem:</p><ul><li>The Hof van Bakenes is tucked away in Haarlem’s city center, making it a delightful surprise for those who discover it.</li><li>Unlike larger public squares, this intimate courtyard provides a quiet escape where visitors can admire its historical charm.</li></ul><p>Respectful Tourism:</p><ul><li>Though primarily a residential area, visitors are welcome to admire the hofje’s architecture and garden while respecting its peaceful atmosphere.</li><li>Guided walking tours often include the Hof van Bakenes as part of Haarlem’s hofjes tradition, showcasing the city’s lesser-known but deeply historic sites.</li></ul>',
        3);


CREATE TABLE track
(
    id        INT AUTO_INCREMENT PRIMARY KEY,
    artist_id INT          NOT NULL,
    name      VARCHAR(100) NOT NULL,
    track     VARCHAR(100) NOT NULL,
    length    INT          NOT NULL,
    cover     VARCHAR(100) NOT NULL,
    CONSTRAINT fk_artist_id_track FOREIGN KEY (artist_id) REFERENCES artist (id)
);

INSERT INTO track (artist_id, name, track, length, cover)
VALUES (1, 'Satisfaction - Hardwell & Maddix Remix', 'Hardwell - Satisfaction - Hardwell & Maddix Remix.mp3', 204,
        'Hardwell - Satisfaction - Hardwell & Maddix Remix.png'),
       (1, 'I Don’t Wanna Wait - Hardwell & Olly James Remix',
        'Hardwell - I Don’t Wanna Wait - Hardwell & Olly James Remix.mp3', 204,
        'Hardwell - I Don’t Wanna Wait - Hardwell & Olly James Remix.png'),
       (1, 'Follow The Light', 'Hardwell - Follow The Light.mp3', 204, 'Hardwell - Follow The Light.png'),
       (1, 'Falling In Love', 'Hardwell - Falling In Love.mp3', 204, 'Hardwell - Falling In Love.png'),
       (2, 'This Is What It Feels Like (feat. Trevor Guthrie)',
        'Armin van Buuren - This Is What It Feels Like (feat. Trevor Guthrie).mp3', 204,
        'Armin van Buuren - This Is What It Feels Like (feat. Trevor Guthrie).png'),
       (2, 'Blah Blah Blah', 'Armin van Buuren - Blah Blah Blah.mp3', 204, 'Armin van Buuren - Blah Blah Blah.png'),
       (2, 'Great Spirit (with Vini Vici & Hilight Tribe)',
        'Armin van Buuren - Great Spirit (with Vini Vici & Hilight Tribe).mp3', 204,
        'Armin van Buuren - Great Spirit (with Vini Vici & Hilight Tribe).png'),
       (2, 'In And Out Of Love (feat. Sharon den Adel)',
        'Armin van Buuren - In And Out Of Love (feat. Sharon den Adel).mp3', 204,
        'Armin van Buuren - In And Out Of Love (feat. Sharon den Adel).png'),
       (3, 'Scared to Be Lonely', 'Martin Garrix - Scared to Be Lonely.mp3', 204,
        'Martin Garrix - Scared to Be Lonely.png'),
       (3, 'In the Name of Love', 'Martin Garrix - In the Name of Love.mp3', 204,
        'Martin Garrix - In the Name of Love.png'),
       (3, 'Told You So', 'Martin Garrix - Told You So.mp3', 204, 'Martin Garrix - Told You So.png'),
       (3, 'Animals', 'Martin Garrix - Animals.mp3', 204, 'Martin Garrix - Animals.png'),
       (4, 'The Business', 'Tiësto - The Business.mp3', 204, 'Tiësto - The Business.png'),
       (4, 'Adagio for Strings', 'Tiësto - Adagio for Strings.mp3', 204, 'Tiësto - Adagio for Strings.png'),
       (4, 'Jackie Chan (with Dzeko, Post Malone & Preme)',
        'Tiësto - Jackie Chan (with Dzeko, Post Malone & Preme).mp3', 204,
        'Tiësto - Jackie Chan (with Dzeko, Post Malone & Preme).png'),
       (4, 'Red Lights', 'Tiësto - Red Lights.mp3', 204, 'Tiësto - Red Lights.png'),
       (5, 'Toulouse', 'Nicky Romero - Toulouse.mp3', 204, 'Nicky Romero - Toulouse.png'),
       (5, 'I Could Be The One (with Avicii)', 'Nicky Romero - I Could Be The One (with Avicii).mp3', 204,
        'Nicky Romero - I Could Be The One (with Avicii).png'),
       (5, 'Legacy (with Krewella)', 'Nicky Romero - Legacy (with Krewella).mp3', 204,
        'Nicky Romero - Legacy (with Krewella).png'),
       (5, 'Symphonica', 'Nicky Romero - Symphonica.mp3', 204, 'Nicky Romero - Symphonica.png'),
       (6, 'Take Over Control (feat. Eva Simons)', 'Afrojack - Take Over Control (feat. Eva Simons).mp3', 204,
        'Afrojack - Take Over Control (feat. Eva Simons).png'),
       (6, 'No Beef (with Steve Aoki)', 'Afrojack - No Beef (with Steve Aoki).mp3', 204,
        'Afrojack - No Beef (with Steve Aoki).png'),
       (6, 'Ten Feet Tall (feat. Wrabel)', 'Afrojack - Ten Feet Tall (feat. Wrabel).mp3', 204,
        'Afrojack - Ten Feet Tall (feat. Wrabel).png'),
       (6, 'Hey Mama (with David Guetta, Nicki Minaj & Bebe Rexha)',
        'Afrojack - Hey Mama (with David Guetta, Nicki Minaj & Bebe Rexha).mp3', 204,
        'Afrojack - Hey Mama (with David Guetta, Nicki Minaj & Bebe Rexha).png');

CREATE TABLE venue
(
    id      INT AUTO_INCREMENT PRIMARY KEY,
    name    VARCHAR(100) NOT NULL,
    address VARCHAR(150) NOT NULL
);

INSERT INTO venue (name, address)
VALUES ('Slachthuis', 'Rockplein 6, 2033 KK Haarlem'),
       ('Caprera Openluchttheater', 'Hoge Duin en Daalseweg 2, 2061 AG Bloemendaal'),
       ('Jopenkerk', 'Gedempte Voldersgracht 2, 2011 WD Haarlem'),
       ('Lichtfabriek', 'Minckelersweg 2, 2031 EM Haarlem'),
       ('Puncher Comedy Club', 'Grote Markt 10, 2011 RD Haarlem'),
       ('XO the Club', 'Grote Markt 8, 2011 RD Haarlem');


CREATE TABLE dance_show
(
    id          INT AUTO_INCREMENT PRIMARY KEY,
    venue_id    INT                                       NOT NULL,
    date_time   DATETIME                                  NOT NULL,
    session     ENUM ('Back2Back', 'Club', 'TiëstoWorld') NOT NULL,
    duration    TIME                                      NOT NULL,
    capacity    INT                                       NOT NULL,
    price       DECIMAL(7, 2)                             NOT NULL,
    description VARCHAR(500)                              NOT NULL,
    CONSTRAINT fk_venue_id_show FOREIGN KEY (venue_id) REFERENCES venue (id)
);

INSERT INTO dance_show (venue_id, date_time, session, duration, capacity, price, description)
VALUES (4, '2025-07-25 20:00:00', 'Back2Back', '06:00:00', 1500, 75.00,
        'Visit Lichtfabriek on Friday 25th at 20:00 to hear Nicky Romero and Afrojack.<br>Address: Minckelersweg 2, 2031 EM Haarlem'),
       (1, '2025-07-25 22:00:00', 'Club', '01:30:00', 200, 60.00,
        'Join Tiësto at Slachthuis on Friday 25th at 22:00.<br>Address: Rockplein 6, 2033 KK Haarlem'),
       (3, '2025-07-25 23:00:00', 'Club', '01:30:00', 300, 60.00,
        'Experience Hardwell at Jopenkerk on Friday 25th at 23:00.<br>Address: Gedempte Voldersgracht 2, 2011 WD Haarlem'),
       (6, '2025-07-25 22:00:00', 'Club', '01:30:00', 200, 60.00,
        'Dance with Armin van Buuren at XO the Club on Friday 25th at 22:00.<br>Address: Grote Markt 8, 2011 RD Haarlem'),
       (5, '2025-07-25 22:00:00', 'Club', '01:30:00', 200, 60.00,
        'Watch Martin Garrix live at Puncher Comedy Club on Friday 25th at 22:00.<br>Address: Grote Markt 10, 2011 RD Haarlem'),
       (2, '2025-07-26 14:00:00', 'Back2Back', '09:00:00', 2000, 110.00,
        'Join Hardwell, Martin Garrix, and Armin van Buuren at Caprera Openluchttheater on Saturday 26th at 14:00.<br>Address: Hoge Duin en Daalseweg 2, 2061 AG Bloemendaal'),
       (3, '2025-07-26 22:00:00', 'Club', '01:30:00', 300, 60.00,
        'Enjoy Afrojack’s beats at Jopenkerk on Saturday 26th at 22:00.<br>Address: Gedempte Voldersgracht 2, 2011 WD Haarlem'),
       (4, '2025-07-26 21:00:00', 'TiëstoWorld', '04:00:00', 1500, 75.00,
        'Experience the exclusive TiëstoWorld** set at Lichtfabriek on Saturday 26th at 21:00.<br>Address: Minckelersweg 2, 2031 EM Haarlem'),
       (1, '2025-07-26 23:00:00', 'Club', '01:30:00', 200, 60.00,
        'Catch Nicky Romero at Slachthuis on Saturday 26th at 23:00.<br>Address: Rockplein 6, 2033 KK Haarlem'),
       (2, '2025-07-27 14:00:00', 'Back2Back', '09:00:00', 2000, 110.00,
        'Watch Afrojack, Tiësto, and Nicky Romero perform back-to-back at Caprera Openluchttheater on Sunday 27th at 14:00.<br>Address: Hoge Duin en Daalseweg 2, 2061 AG Bloemendaal'),
       (3, '2025-07-27 19:00:00', 'Club', '01:30:00', 300, 60.00,
        'See Armin van Buuren live at Jopenkerk on Sunday 27th at 19:00.<br>Address: Gedempte Voldersgracht 2, 2011 WD Haarlem'),
       (6, '2025-07-27 21:00:00', 'Club', '01:30:00', 1500, 90.00,
        'Get ready for Hardwell at XO the Club on Sunday 27th at 21:00.<br>Address: Grote Markt 8, 2011 RD Haarlem'),
       (1, '2025-07-27 18:00:00', 'Club', '01:30:00', 200, 60.00,
        'Enjoy Martin Garrix’s closing set at Slachthuis on Sunday 27th at 18:00.<br>Address: Rockplein 6, 2033 KK Haarlem');


CREATE TABLE participant
(
    dance_show_id INT NOT NULL,
    artist_id     INT NOT NULL,
    CONSTRAINT fk_dance_show_id_performance FOREIGN KEY (dance_show_id) REFERENCES dance_show (id),
    CONSTRAINT fk_artist_id_performance FOREIGN KEY (artist_id) REFERENCES artist (id)
);

INSERT INTO participant (dance_show_id, artist_id)
VALUES (1, 5),
       (1, 6),
       (2, 4),
       (3, 1),
       (4, 2),
       (5, 3),
       (6, 1),
       (6, 2),
       (6, 3),
       (7, 6),
       (8, 4),
       (9, 5),
       (10, 4),
       (10, 5),
       (10, 6),
       (11, 2),
       (12, 1),
       (13, 3);


CREATE TABLE pass
(
    id         INT AUTO_INCREMENT PRIMARY KEY,
    event_id   INT                                                 NOT NULL,
    name       VARCHAR(50),
    price      DECIMAL(7, 2)                                       NOT NULL,
    day        ENUM ('Friday', 'Saturday', 'Sunday', 'All-Access') NOT NULL,
    start_date DATETIME
);

INSERT INTO pass (event_id, name, price, day, start_date)
VALUES (2, 'Friday Pass', 125.00, 'Friday', '2025-07-25 20:00:00'),
       (2, 'Saturday Pass', 150.00, 'Saturday', '2025-07-26 14:00:00'),
       (2, 'Sunday Pass', 150.00, 'Sunday', '2025-07-27 20:00:00'),
       (2, 'All-Access Pass', 250.00, 'All-Access', '2025-07-25 20:00:00');


CREATE TABLE reservation
(
    id            INT AUTO_INCREMENT PRIMARY KEY,
    restaurant_id INT      NOT NULL,
    date_time     DATETIME NOT NULL,
    adults        INT      NOT NULL,
    kids          INT      NOT NULL,
    comment       VARCHAR(500),
    CONSTRAINT fk_restaurant_id_reservation FOREIGN KEY (restaurant_id) REFERENCES restaurant (id)
);

INSERT INTO reservation (restaurant_id, date_time, adults, kids, comment)
VALUES (1, '2025-07-25 19:00:00', 2, 2, 'One kid has strawberry allergy');


CREATE TABLE teylers_show
(
    id   INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL
);

INSERT INTO teylers_show (name)
VALUES ('The Secret of Professor Teyler'),
       ('The Lorentz Formula');


CREATE TABLE teylers_event
(
    id              INT AUTO_INCREMENT PRIMARY KEY,
    show_id         INT      NOT NULL,
    start_date_time DATETIME NOT NULL,
    end_date_time   DATETIME NOT NULL,
    CONSTRAINT fk_teylers_show_id_teylers FOREIGN KEY (show_id) REFERENCES teylers_show (id)
);

INSERT INTO teylers_event (show_id, start_date_time, end_date_time)
VALUES (1, '2025-07-24 10:00:00', '2025-07-24 17:00:00'),
       (1, '2025-07-25 10:00:00', '2025-07-25 17:00:00'),
       (2, '2025-07-25 12:30:00', '2025-07-25 13:20:00'),
       (2, '2025-07-25 14:00:00', '2025-07-25 14:50:00'),
       (2, '2025-07-25 15:00:00', '2025-07-25 15:50:00'),
       (1, '2025-07-26 10:00:00', '2025-07-26 17:00:00'),
       (2, '2025-07-26 12:30:00', '2025-07-26 13:20:00'),
       (2, '2025-07-26 14:00:00', '2025-07-26 14:50:00'),
       (2, '2025-07-26 15:00:00', '2025-07-26 15:50:00'),
       (1, '2025-07-27 10:00:00', '2025-07-27 17:00:00'),
       (2, '2025-07-27 12:30:00', '2025-07-27 13:20:00'),
       (2, '2025-07-27 14:00:00', '2025-07-27 14:50:00'),
       (2, '2025-07-27 15:00:00', '2025-07-27 15:50:00');


CREATE TABLE user
(
    id         INT AUTO_INCREMENT PRIMARY KEY,
    email      VARCHAR(254)                                   NOT NULL,
    password   VARCHAR(64)                                    NOT NULL,
    role       ENUM ('Customer', 'Employee', 'Administrator') NOT NULL,
    created_at DATETIME                                       NOT NULL,
    name       VARCHAR(100)                                   NOT NULL
);

INSERT INTO user (email, password, role, created_at, name)
VALUES ('123emp@mail.com', '$2y$12$SI3.l5PY5nWimBXtCMZ4cenGk6TtkmeE9FYJF649FHUv5xUfPqMTy', 'Employee', NOW(), 'John Doe'),
       ('123@mail.com', '$2y$12$SI3.l5PY5nWimBXtCMZ4cenGk6TtkmeE9FYJF649FHUv5xUfPqMTy', 'Customer', NOW(), 'Maria'),
       ('123admin@mail.com', '$2y$12$SI3.l5PY5nWimBXtCMZ4cenGk6TtkmeE9FYJF649FHUv5xUfPqMTy', 'Administrator', NOW(), 'Mara Baker');


CREATE TABLE booking
(
    id              INT AUTO_INCREMENT PRIMARY KEY,
    user_id         INT                                                                 NOT NULL,
    order_number    VARCHAR(10),
    receiving_email VARCHAR(254),
    ticket_type     ENUM ('pass', 'dance_show', 'reservation', 'tour', 'teylers_event') NOT NULL,
    ticket_subtype  ENUM ('Kids', 'Adults', 'Family', 'Individual')                     NULL,
    ticket_id       INT                                                                 NOT NULL,
    quantity        INT                                                                 NOT NULL,
    CONSTRAINT fk_user_id_booking FOREIGN KEY (user_id) REFERENCES user (id)
);

INSERT INTO booking (user_id, order_number, receiving_email, ticket_type, ticket_subtype, ticket_id, quantity)
VALUES (2, 'KCJ145', '123@mail.com', 'pass', null, 2, 2),
       (2, 'KCJ145', '123@mail.com', 'dance_show', null, 3, 1),
       (2, 'KCJ145', '123@mail.com', 'tour', null, 7, 1),
       (2, 'KCJ145', '123@mail.com', 'teylers_event', null, 9, 2),
       (2, 'KCJ145', '123@mail.com', 'reservation', null, 1, 1);


CREATE TABLE button_type
(
    id   INT AUTO_INCREMENT PRIMARY KEY,
    type VARCHAR(200) NOT NULL,
    text VARCHAR(200) NOT NULL,
    icon VARCHAR(100)
);

INSERT INTO button_type (type, text, icon)
VALUES ('discover', 'Discover', NULL),
       ('location', 'How to get there?', NULL),
       ('learn_more', 'Learn more', NULL),
       ('add_to_cart', 'Add to cart', 'shopping_cart.svg'),
       ('send', 'Send', NULL),
       ('buy_pass', 'Buy Pass', NULL),
       ('buy_tickets', 'Buy Tickets', NULL),
       ('book_now', 'Book now', NULL);


CREATE TABLE button
(
    id      INT AUTO_INCREMENT PRIMARY KEY,
    type_id INT NOT NULL,
    link    VARCHAR(200),
    CONSTRAINT fk_type_id_button FOREIGN KEY (type_id) REFERENCES button_type (id)
);

INSERT INTO button (type_id, link)
VALUES (1, '/teylers'),
       (1, '/yummy'),
       (1, '/strolls'),
       (1, '/dance'),
       (6, NULL),
       (7, '/strolls/schedule'),
       (3, '/dance/hardwell'),
       (3, '/dance/armin-van-buuren'),
       (3, '/dance/martin-garrix'),
       (3, '/dance/tiesto'),
       (3, '/dance/nicky-romero'),
       (3, '/dance/afrojack'),
       (7, NULL);


CREATE TABLE schedule
(
    id          INT AUTO_INCREMENT PRIMARY KEY,
    date        DATE        NOT NULL,
    title       VARCHAR(50) NOT NULL,
    start_time  TIME        NOT NULL,
    end_time    TIME        NOT NULL,
    title_color VARCHAR(6)  NOT NULL
);

INSERT INTO schedule (date, title, start_time, end_time, title_color) VALUE
    ('2025-07-24', 'Magic@Teylers', '10:00:00', '17:00:00', '00796B'),
    ('2025-07-24', 'Yummy!', '16:30:00', '23:00:00', 'E66B5B'),
    ('2025-07-24', 'A Stroll through History', '10:00:00', '18:30:00', 'D43D25'),
    ('2025-07-25', 'Magic@Teylers', '10:00:00', '17:00:00', '00796B'),
    ('2025-07-25', 'Yummy!', '16:30:00', '23:00:00', 'E66B5B'),
    ('2025-07-25', 'A Stroll through History', '10:00:00', '18:30:00', 'D43D25'),
    ('2025-07-25', 'DANCE!', '20:00:00', '02:00:00', '6A7AB3'),
    ('2025-07-26', 'Magic@Teylers', '10:00:00', '17:00:00', '00796B'),
    ('2025-07-26', 'Yummy!', '16:30:00', '23:00:00', 'E66B5B'),
    ('2025-07-26', 'A Stroll through History', '10:00:00', '18:30:00', 'D43D25'),
    ('2025-07-26', 'DANCE!', '14:00:00', '01:00:00', '6A7AB3'),
    ('2025-07-27', 'Magic@Teylers', '10:00:00', '17:00:00', '00796B'),
    ('2025-07-27', 'Yummy!', '16:30:00', '23:00:00', 'E66B5B'),
    ('2025-07-27', 'A Stroll through History', '10:00:00', '18:30:00', 'D43D25'),
    ('2025-07-27', 'DANCE!', '14:00:00', '23:00:00', '6A7AB3');


CREATE TABLE social_media
(
    id            INT AUTO_INCREMENT PRIMARY KEY,
    restaurant_id INT          NOT NULL,
    platform      ENUM ('Facebook', 'Instagram'),
    link          VARCHAR(500) NOT NULL,
    CONSTRAINT fk_restaurant_id_social_media FOREIGN KEY (restaurant_id) REFERENCES restaurant (id)
);

INSERT INTO social_media (restaurant_id, platform, link)
VALUES (1, 'Facebook', 'https://www.facebook.com/RatatouilleFoodandWine'),
       (1, 'Instagram', 'https://www.instagram.com/ratatouille_food_and_wine'),
       (2, 'Facebook', 'https://www.facebook.com/RestaurantML'),
       (2, 'Instagram', 'https://www.instagram.com/mlinhaarlem'),
       (3, 'Facebook', 'https://www.facebook.com/RestaurantFris'),
       (3, 'Instagram', 'https://www.instagram.com/restaurantfris'),
       (4, 'Facebook', 'https://www.facebook.com/cafederoemer'),
       (4, 'Instagram', 'https://www.instagram.com/cafe.de.roemer'),
       (5, 'Facebook', 'https://www.facebook.com/toujoursrestaurant'),
       (5, 'Instagram', 'https://www.instagram.com/toujourshaarlem'),
       (6, 'Facebook', 'https://www.facebook.com/newvegasofficial'),
       (6, 'Instagram', 'https://www.instagram.com/newvegas_official'),
       (7, 'Facebook', 'https://www.facebook.com/GrandCafeBrinkmann'),
       (7, 'Instagram', 'https://www.instagram.com/brinkmannhaarlem');


CREATE TABLE custom
(
    id         INT AUTO_INCREMENT PRIMARY KEY,
    identifier VARCHAR(100)  NOT NULL UNIQUE,
    content    VARCHAR(2000) NOT NULL
);

INSERT INTO custom (identifier, content)
VALUES ('strolls_title_tour_info', 'Tour information'),
       ('strolls_description_tour_info',
        '<p><b>The tour price includes one drink per person:</b></p><ul><li>For regular participants, the cost is €17.50 per person.</li><li>Families (up to 4 participants) can enjoy the tour for €60.</li></ul><p><b>Additional Information:</b></p><ul><li>Due to the nature of this walk, participants must be at least 12 years old, and strollers are not allowed.</li><li>Each group will consist of 12 participants and 1 guide.</li><li>At the end of the tour, participants will receive a personalized digital postcard, capturing highlights from their journey through historic Haarlem.</li></ul>'),
       ('app_promotion_title', 'HAVE FUN ON OUR NEW APP AND DISCOVER PROFESSOR TYLER’S SECRET !'),
       ('app_promotion_subtitle', 'Download the app now'),
       ('filters_prompt', 'Filter restaurants by food type:'),
       ('lorentz_bg', 'lorentz.png'),
       ('lorentz_title', 'The Lorentz Formula'),
       ('lorentz_subtitle', 'A Theatrical Tour of the Lorentz Lab on Friday, Saturday and Sunday'),
       ('lorentz_description',
        'In this theatrical performance on location, two actors take you back in time, to the years when Nobel Prize winner Hendrik Lorentz had his own study and laboratory in Teylers Museum (1909-1928). Here, you will discover who Lorentz was and how important he was to science.<br><br>For The Lorentz Formula register at the museum, you can sign up to participate at their website. There is room for 20 people at a time. The performance is suitable for anyone ages 10 and up.'),
       ('lorentz_schedule_title', 'View Schedule'),
       ('lorentz_schedule_description',
        'The Lorentz Formula performance in the Lorentz Lab is offered on Friday, Saturday and Sunday at 12:30, 14:00 and 15:00'),
       ('app_promotion_title_2',
        'Discover a World of Mystery with Magic@Teyler’s AppDiscover a World of Mystery with Magic@Teyler’s App'),
       ('app_promotion_description',
        '<p>🎮 Your Mission:</p><ul><li>Help Professor Teyler by solving exciting challenges.</li><li>Collect clues as you explore the museum.</li><li>Piece together the mystery and find the secret Code!</li></ul><p>✨ The professor is counting on you. Are you ready to begin?</p>'),
       ('app_promotion_image_1', 'app_promotion_image_1.png'),
       ('app_promotion_image_2', 'app_promotion_image_2.png'),
       ('app_promotion_title_3', 'Scan To Download Teyler’s Mystery App'),
       ('home_page_must_see', 'CHECK OUT THESE MUST SEE EVENTS !!!'),
       ('book_table_title', 'Book a table'),
       ('book_table_description',
        'Reservation is mandatory. A reservation fee of € 10,00 per person will be charged when a reservation is made on The Festival website. This fee will be deducted from the final check on visiting the restaurant. The reservation fee is non-refundable.'),
       ('contact_restaurant_title', 'Have a question? Feel free to ask the restaurant in the form below!'),
       ('schedule_title', 'EVENT SCHEDULE'),
       ('schedule_subtitle', 'July - 2025'),
       ('strolls_schedule_title', 'Select Your Tour Date, Time, and Guide'),
       ('strolls_schedule_subtitle', 'Schedule'),
       ('teyler_title', 'The Secret of Professor Teyler'),
       ('teyler_description',
        'Participants of The Secret of Professor Teyler need to download the app and buy tickets at the Teylers Museum.');
