<?php
// PDO database configuration
$dsn = 'mysql:host=localhost;dbname=ford;charset=utf8mb4';
$username = 'root';
$password = '';
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $username, $password, $options);
    $stmt = $pdo->query('SELECT * FROM basvurular ORDER BY created_at DESC');
    $applications = $stmt->fetchAll();
} catch (PDOException $e) {
    die('Veri tabanına bağlanılamadı: ' . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Başvurular Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
</head>
<body class="bg-gray-100">
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-semibold mb-4">Başvurular Dashboard</h1>
    <div class="overflow-x-auto bg-white p-4 shadow rounded">
        <table id="applications" class="display" style="width:100%">
            <thead>
            <tr>
                <th>ID</th>
                <th>Ad Soyad</th>
                <th>E-posta</th>
                <th>Telefon</th>
                <th>Öğrenci mi?</th>
                <th>KVKK</th>
                <th>Üniversite</th>
                <th>Bölüm</th>
                <th>Sınıf</th>
                <th>Katılım</th>
                <th>Staj Var mı?</th>
                <th>Önceki Etkinlikler</th>
                <th>Engel Durumu</th>
                <th>Engel Detayları</th>
                <th>Erişilebilirlik İhtiyacı</th>
                <th>Ek Bilgi</th>
                <th>Oluşturma Tarihi</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($applications as $app): ?>
                <tr>
                    <td><?= htmlspecialchars($app['id']) ?></td>
                    <td><?= htmlspecialchars($app['fullName']) ?></td>
                    <td><?= htmlspecialchars($app['email']) ?></td>
                    <td><?= htmlspecialchars($app['phone']) ?></td>
                    <td><?= $app['isUndergraduate'] ? 'Evet' : 'Hayır' ?></td>
                    <td><?= $app['kvkkConsent'] ? 'Onaylı' : 'Onaysız' ?></td>
                    <td><?= htmlspecialchars($app['university']) ?></td>
                    <td><?= htmlspecialchars($app['department']) ?></td>
                    <td><?= htmlspecialchars($app['grade']) ?></td>
                    <td><?= htmlspecialchars($app['participation']) ?></td>
                    <td><?= $app['hasInternship'] ? 'Evet' : 'Hayır' ?></td>
                    <td><?= htmlspecialchars($app['previousEvents']) ?></td>
                    <td><?= $app['hasDisability'] ? 'Evet' : 'Hayır' ?></td>
                    <td><?= htmlspecialchars($app['disabilityDetails']) ?></td>
                    <td><?= htmlspecialchars($app['accessibilityNeeds']) ?></td>
                    <td><?= htmlspecialchars($app['additionalInfo']) ?></td>
                    <td><?= htmlspecialchars($app['created_at']) ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#applications').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.10.24/i18n/Turkish.json'
            }
        });
    });
</script>
</body>
</html>
