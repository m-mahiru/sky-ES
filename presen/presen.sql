DROP TABLE book_list;
DROP TABLE book_rental;
DROP TABLE regist_cate;

CREATE TABLE book_list (
	name   TEXT primary key,
	name_hira text,
	category text,
	author  text,
	author_hira text
);

CREATE TABLE book_rental (
	id   INT  PRIMARY KEY,
	name   TEXT,
	category  text,
	author  text
);

CREATE TABLE regist_cate (
	id_cate   INT  PRIMARY KEY,
	name_cate  text
);

INSERT INTO book_list  VALUES ('6人の嘘つきな大学生','ろくにんのうそつきなだいがくせい', '小説', '浅倉秋成','あさくらしゅうせい');
INSERT INTO book_list  VALUES ('金のフレーズ','きんのふれーず', '資格', 'TEX加藤','てっくすかとう');
INSERT INTO book_list  VALUES ('編入数学徹底研究','へんにゅうすうがくてっていけんきゅう', '数学', '桜井基晴','さくらいもとはる');
INSERT INTO book_list  VALUES ('中国語入門','中国語入門', '文学', '中国教育研究会','ちゅうごくきょういくけんきゅうかい');
INSERT INTO book_list  VALUES ('電気工学の基礎','でんきこうがくのきそ', '電気工学', '湊かなえ','みなとかなえ');
INSERT INTO book_list  VALUES ('はじめての工学倫理','はじめてのこうがくりんり', '法律・経済', '坂下浩司','さかしたこうじ');
insert into regist_cate values('10','資格');
insert into regist_cate values('20','文学');
insert into regist_cate values('30','電気工学');
insert into regist_cate values('40','スポーツ');
insert into regist_cate values('50','産業');
insert into regist_cate values('60','機械工学');
insert into regist_cate values('70','化学');
insert into regist_cate values('80','数学');
insert into regist_cate values('90','法律・経済');
insert into regist_cate values('100','小説');

GRANT ALL ON book_list  TO apache;
GRANT ALL ON book_rental TO apache;
GRANT ALL ON regist_cate  TO apache;
