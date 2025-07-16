<?php
// filepath: bimbingan-konseling-online/backend/stories.php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

$filename = __DIR__ . '/stories.json';

// Handle preflight
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

// Helper: Read & Write JSON
function readStories($filename) {
    if (!file_exists($filename)) return [];
    $json = file_get_contents($filename);
    return json_decode($json, true) ?: [];
}
function writeStories($filename, $data) {
    file_put_contents($filename, json_encode($data, JSON_PRETTY_PRINT));
}

// GET stories
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $stories = readStories($filename);
    if (isset($_GET['type']) && $_GET['type'] === 'private') {
        $stories = array_filter($stories, fn($s) => $s['type'] === 'private');
    } else {
        $stories = array_filter($stories, fn($s) => $s['type'] === 'public');
    }
    echo json_encode(array_values($stories));
    exit;
}

// POST new story or comment
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    $stories = readStories($filename);

    // Add comment
    if (isset($_GET['comment']) && isset($_GET['id'])) {
        foreach ($stories as &$story) {
            if ($story['id'] == $_GET['id']) {
                $story['comments'][] = $input['comment'];
                writeStories($filename, $stories);
                echo json_encode(['success' => true, 'comments' => $story['comments']]);
                exit;
            }
        }
        echo json_encode(['error' => 'Story not found']);
        exit;
    }

    // Add new story
    if (isset($input['type']) && isset($input['content'])) {
        $newStory = [
            'id' => time(),
            'name' => $input['name'] ?? 'Anonim',
            'type' => $input['type'],
            'content' => $input['content'],
            'date' => date('d-m-Y H:i'),
            'comments' => []
        ];
        array_unshift($stories, $newStory);
        writeStories($filename, $stories);
        echo json_encode(['success' => true, 'story' => $newStory]);
        exit;
    }
    echo json_encode(['error' => 'Invalid data']);
    exit;
}
file_put_contents(__DIR__.'/test.txt', 'test');