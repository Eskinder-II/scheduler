<?php
header('Content-Type: text/html; charset=utf-8');
session_start();

// Simple routing for API requests
if ($_SERVER['REQUEST_METHOD'] !== 'GET' || !empty($_GET)) {
    header('Location: api.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Scheduler</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <!-- Header -->
        <header class="header">
            <div class="header-content">
                <h1>📅 My Schedule</h1>
                <div class="header-controls">
                    <input 
                        type="text" 
                        id="searchInput" 
                        class="search-bar" 
                        placeholder="Search tasks..."
                        aria-label="Search tasks"
                    >
                    <button id="darkModeToggle" class="dark-mode-btn" aria-label="Toggle dark mode">
                        🌙
                    </button>
                </div>
            </div>
        </header>

        <!-- New Event Form -->
        <section class="form-section">
            <h2>Add New Task</h2>
            <form id="eventForm" class="event-form">
                <div class="form-group">
                    <label for="title">Task Title *</label>
                    <input 
                        type="text" 
                        id="title" 
                        name="title" 
                        required
                        maxlength="255"
                        placeholder="Enter task title"
                    >
                    <span class="error-msg" id="titleError"></span>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea 
                        id="description" 
                        name="description"
                        placeholder="Add details (optional)"
                        rows="3"
                    ></textarea>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="startTime">Start Time *</label>
                        <input 
                            type="datetime-local" 
                            id="startTime" 
                            name="start_time" 
                            required
                        >
                        <span class="error-msg" id="startTimeError"></span>
                    </div>

                    <div class="form-group">
                        <label for="endTime">End Time *</label>
                        <input 
                            type="datetime-local" 
                            id="endTime" 
                            name="end_time" 
                            required
                        >
                        <span class="error-msg" id="endTimeError"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="priority">Priority</label>
                    <select id="priority" name="priority">
                        <option value="low">Low</option>
                        <option value="medium" selected>Medium</option>
                        <option value="high">High</option>
                    </select>
                </div>

                <button type="submit" class="btn-primary">Add Task</button>
            </form>
        </section>

        <!-- View Toggle -->
        <div class="view-toggle">
            <button id="weekViewBtn" class="view-btn active">Week View</button>
            <button id="listViewBtn" class="view-btn">List View</button>
        </div>

        <!-- Week View -->
        <section id="weekView" class="week-view active">
            <div class="week-grid" id="weekGrid"></div>
        </section>

        <!-- List View -->
        <section id="listView" class="list-view">
            <div id="eventsList" class="events-list"></div>
            <div id="emptyState" class="empty-state">
                <p>No tasks scheduled. Create one to get started! 🚀</p>
            </div>
        </section>

        <!-- Loading Spinner -->
        <div id="loadingSpinner" class="spinner hidden"></div>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" class="modal hidden">
        <div class="modal-content">
            <span class="modal-close">&times;</span>
            <h2>Edit Task</h2>
            <form id="editForm" class="event-form">
                <input type="hidden" id="editId" name="id">
                
                <div class="form-group">
                    <label for="editTitle">Task Title *</label>
                    <input 
                        type="text" 
                        id="editTitle" 
                        name="title" 
                        required
                        maxlength="255"
                    >
                </div>

                <div class="form-group">
                    <label for="editDescription">Description</label>
                    <textarea 
                        id="editDescription" 
                        name="description"
                        rows="3"
                    ></textarea>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="editStartTime">Start Time *</label>
                        <input 
                            type="datetime-local" 
                            id="editStartTime" 
                            name="start_time" 
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label for="editEndTime">End Time *</label>
                        <input 
                            type="datetime-local" 
                            id="editEndTime" 
                            name="end_time" 
                            required
                        >
                    </div>
                </div>

                <div class="form-group">
                    <label for="editPriority">Priority</label>
                    <select id="editPriority" name="priority">
                        <option value="low">Low</option>
                        <option value="medium">Medium</option>
                        <option value="high">High</option>
                    </select>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-primary">Update Task</button>
                    <button type="button" id="deleteBtn" class="btn-danger">Delete Task</button>
                    <button type="button" class="btn-secondary modal-close-btn">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <script src="app.js"></script>
</body>
</html>
