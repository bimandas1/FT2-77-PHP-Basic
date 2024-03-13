-- Teams table
create table teams (t_id int primary key auto_increment, t_name varchar(30), captain varchar(30));
-- Insert to table
insert into teams(t_name, captain) values
('csk', 'ms dhoni'),
('kkr', 'sourav ganguli'),
('srh', 'patt commins'),
('ppks', 'shekhar dhawans'),
('rcb', 'virat kohli'),
('mi', 'rohit sharma');

-- Match table
create table matches (m_id int primary key auto_increment, venue varchar(30), date DATE, team1_id int, team2_id int, toss_win int, match_win int, foreign key (team1_id) references teams(t_id) on delete cascade, foreign key (team2_id) references teams(t_id) on delete cascade);
-- Insert to table
insert into matches(venue, date, team1_id, team2_id, toss_win, match_win) values
('kolkata', '2023-8-15', 1, 4, 1, 1),
('kolkata', '2023-8-24', 2, 4, 2, 4),
('kolkata', '2023-8-24', 5, 1, 5, 1),
('kolkata', '2023-9-2', 4, 5, 5, 4);

-- Query
select * from  matches JOIN teams on team1_id = teams.t_id  JOIN teams as t2 on team2_id = t2.t_id;
-- Same query as above but different columns selected.
select m_id, venue, date, teams.t_name as TEAM_1, t2.t_name as TEAM_2 from    matches JOIN teams on team1_id = teams.t_id    JOIN teams as t2 on team2_id = t2.t_id;
