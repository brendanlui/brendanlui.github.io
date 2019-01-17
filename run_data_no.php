
<?php
//need to comment avoid duplicate
include 'config_database_value.php';
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect($servername, $username, $password, $dbname);
mysqli_set_charset($link, "utf8"); //view the chinese word in sql with Nvarchar

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
// Attempt insert query execution
$sql = "INSERT INTO database_movie_no (video, photo, duration, size, date, state, fee, viewcount) VALUES
            ('漢物丁格吊打雷文LOL.mp4', 'Heimerdinger.jpg', '0:00:21', '9.44MB', '20170624', 'Free', '$0.00', 0),
            ('機械人神拉_神反LOL.mp4', 'Blitzcrank.jpg', '0:00:16', '6.17MB', '20170719', 'Free', '$0.00', 0),
            ('漢物丁格與機械人LOL.mp4', 'Heimerdinger.jpg', '0:00:25', '10.6MB', '20170723', 'Free', '$0.00', 0),
            ('西游伏妖篇.2017.HD1080P.x264.国语粤语中文字幕.btrenren.mp4', '西游伏妖篇.jpg', '1:48:40', '3.42GB', '20170723', 'Free', '$0.00', 0),
            ('丹麦女孩[rarbt.com]丹麦女孩.The.Danish.Girl.2015.BD1080P.x264.AC3.English.CHS.中文字幕.rarbt.MP4', '丹麦女孩.jpg', '1:59:32', '3.10GB', '20170724', 'Free', '$0.00', 0),
            ('春娇救志明.Love.off.the.cuff.2017.HD1080P.x264.国粤中文字幕.btrenren.mp4', '春娇救志明.jpg', '1:57:44', '2.78GB', '20170724', 'Free', '$0.00', 0),
            ('格雷的五十道色戒2(五十度黑未删减完整版).Fifty.Shades.Darker.UNRATED.2017.BD1080P.x264.官方中文字幕完整版.btrenren.mp4', '格雷的五十道色戒2.jpg', '2:11:29', '4.02GB', '20170724', 'Free', '$0.00', 0),
            ('國定殺戮日：大選之年[BT乐园·bt606.com]人类清除计划3.HD720P.X264.AAC.中文字幕.mp4', '國定殺戮日：大選之年.jpg', '1:52:18', '1.75GB', '20170724', 'Free', '$0.00', 0),
            ('虛擬都市(被操纵的城市).Fabricated.City.2017.HD1080P.x264.精校中文字幕.btrenren.mp4', '虛擬都市.jpg', '2:06:53', '3.45GB', '20170724', 'Free', '$0.00', 0),
            ('選老頂[HDzone]The.Mobfathers.2016.720p.BluRay.x264.mp4', '選老頂.jpg', '1:32:51', '1.70GB', '20170724', 'Free', '$0.00', 0),
            ('生化危機：血仇殺戮_生化危机.复仇.Resident.Evil.Vendetta.2017.HD1080P.x264.官方中文字幕.btrenren.mp4', '生化危機：血仇殺戮.jpg', '1:37:14', '2.97GB', '20170724', 'Free', '$0.00', 0),
            ('生化危機：終極屍殺_生化.危.机.终章完整版.2017.HD1080P.x264.官方中文字幕.btrenren.mp4', '生化危機：終極屍殺.jpg', '1:47:03', '3.27GB', '20170725', 'Free', '$0.00', 0),
            ('死亡筆記：照亮新世界_死亡笔记.点亮新世界.Light.Up.the.New.World.2016.BD720P.x264.日语中文字幕.btrenren.mp4', '死亡筆記：照亮新世界.jpg', '2:14:50', '3.42GB', '20170725', 'Free', '$0.00', 0),
            ('搶錢耆兵_三个老枪手.Going.in.Style.2017.HD1080P.x264.中英双字幕.btrenren.mp4', '搶錢耆兵.jpg', '1:36:24', '2.95GB', '20170726', 'Free', '$0.00', 0),
('低俗殭屍玩出征_吸血鬼生活.原盘中英字幕.What.We.Do.in.the.Shadows.2014.BD720P.X264.AAC.English&Cantones.CHS-ENG.Mp4Ba.mp4', '低俗殭屍玩出征.jpg', '1:25:47', '1.67GB', '20170802', 'Free', '$0.00', 0),
('明日世界_Tomorrowland.2015.720p.WEBRip.x264.ACC2.0-RARBG.mp4', '明日世界.jpg', '2:10:03', '2.43GB', '20170802', 'Free', '$0.00', 0),
('星球大戰－原力覺醒_Star.Wars.Episode.VII.The.Force.Awakens.2015.1080p.BluRay.H264.AAC-RARBG.mp4', '星球大戰－原力覺醒.jpg', '2:18:06', '2.63GB', '20170802', 'Free', '$0.00', 0),
('特工爺爺_W的特工爷爷.My.Beloved.Bodyguard.2016.HD1080P.X264.AAC.Cantonese&Mandarin.CHS-ENG.Mp4Ba.mp4', '特工爺爺.jpg', '1:37:05', '3.81GB', '20170802', 'Free', '$0.00', 0),
('壹獄壹世界高登闊少踎監日記_一狱一世界：高登阔少蹲监日记.Imprisoned.Survival.Guide.for.Rich.and.Prodigal..mp4', '壹獄壹世界高登闊少踎監日記.jpg', '1:51:52', '2.47GB', '20170802', 'Free', '$0.00', 0),
('傲慢與屍變_Pride.and.Prejudice.and.Zombies.2016.1080p.WEBRip.x264.AAC2.0-FGT.mp4', '傲慢與屍變.jpg', '1:42:46', '3.26GB', '20170802', 'Free', '$0.00', 0),
('霍金：愛的方程式_The.Theory.of.Everything.2014.1080p.BluRay.H264.AAC-RARBG.mp4', '霍金：愛的方程式.jpg', '2:03:25', '2.35GB', '20170802', 'Free', '$0.00', 0),
('魔獸爭霸：戰雄崛起_Warcraft.2016.1080p.HDRip.KORSUB.x264.AAC2.0-STUTTERSHIT.mp4', '魔獸爭霸：戰雄崛起.jpg', '2:01:05', '3.96GB', '20170802', 'Free', '$0.00', 0),
('移動迷宮：焦土試煉＿Maze.Runner.The.Scorch.Trials.2015.mp4', '移動迷宮：焦土試煉.jpg', '2:11:30', '3.41GB', '20170802', 'Free', '$0.00', 0),
('麻雀王.King.of.Mahjong.2015.HD720P.X264.AAC.Cantonese.CHS.Mp4Ba.mp4', '麻雀王.jpg', '1:50:06', '1.68GB', '20170804', 'Free', '$0.00', 0),
('猩球崛起2：黎明之战.特效中英字幕.mp4', '猩球崛起2：黎明之戰.jpg', '2:10:25', '2.94GB', '20170815', 'Free', '$0.00', 0)




			";
if(mysqli_query($link, $sql)){
    echo "Records added successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

// Close connection
mysqli_close($link);
?>