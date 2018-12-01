


CREATE TABLE IF NOT EXISTS students (
    id INT AUTO_INCREMENT,
    name  VARCHAR(255) NOT NULL,
    created_at TIMESTAMP  DEFAULT CURRENT_TIMESTAMP, 
    updated_at TIMESTAMP  DEFAULT 0,
    PRIMARY KEY (id)
);
CREATE TABLE IF NOT EXISTS teachers (
    id INT AUTO_INCREMENT,
    name  VARCHAR(255) NOT NULL,
    created_at TIMESTAMP  DEFAULT CURRENT_TIMESTAMP, 
    updated_at TIMESTAMP  DEFAULT 0,
    PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS appointments (
    id INT AUTO_INCREMENT,
    student_id INT,
    teacher_id INT,
    start_date TIMESTAMP NULL DEFAULT 0,
    start_time TIME NOT NULL,
    end_time TIME NOT NULL,
    notes TEXT,
    created_at TIMESTAMP  DEFAULT CURRENT_TIMESTAMP, 
    updated_at TIMESTAMP  DEFAULT 0,
    INDEX (student_id),
    INDEX (teacher_id),
    FOREIGN KEY (student_id)
        REFERENCES students(id)
        ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (teacher_id)
        REFERENCES teachers(id)
        ON UPDATE CASCADE,
    PRIMARY KEY (id)
);




CREATE TRIGGER updated_updater 
BEFORE UPDATE ON appointments
    FOR EACH ROW 
BEGIN
    SET new.updated_at = CURRENT_TIMESTAMP;
END

INSERT INTO appointments (student_id, student_name, teacher_id, teacher_name, start_date_time, end_date_time, description) VALUES ( 1, 'ricky', 11, 'jennifer', NOW(), NOW(), 'description description');

INSERT INTO teachers (name) VALUES (  'Jose Miramontes');
INSERT INTO teachers (name) VALUES (  'Ricardo Ontiveros');
INSERT INTO teachers (name) VALUES (  'Saul Arrazate');
INSERT INTO teachers (name) VALUES (  'Enrique Rivera');


INSERT INTO students (name) VALUES (  'Jose Guadalupe' );
INSERT INTO students (name) VALUES (  'Choche Perez' );
INSERT INTO students (name) VALUES (  'Ramiro Gonzalez' );
INSERT INTO students (name) VALUES (  'Marco Antonio Regil' );
INSERT INTO students (name) VALUES (  'Juan Gabriel' );

INSERT INTO appointments (student_id, teacher_id,  start_date, start_time, end_time, notes) VALUES ( 1,  3,  NOW(), '16:00', '17:00', 'notes notes');

select p.col1, c.col2 from appointments p left outer join child c on c.col1 = p.col1;
select date(a.start_date) as 'date' , s.name as 'student_name',  t.name as 'teacher_name', a.start_time, a.end_time, a.notes  FROM appointments a JOIN students s ON a.student_id = s.id JOIN teachers t ON a.teacher_id = t.id ;


update appointments set student_name='ricchar' where id=1;