<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $organizerOneId = DB::table('users')
            ->where('email', 'organizer1@gmail.com')
            ->where('role', 'organizer')
            ->value('id');

        $organizerTwoId = DB::table('users')
            ->where('email', 'organizer2@gmail.com')
            ->where('role', 'organizer')
            ->value('id');

        if (!$organizerOneId || !$organizerTwoId) {
            throw new RuntimeException(
                'Expected Organizer users (organizer1@gmail.com, organizer2@gmail.com) to exist. Run UserSeeder first.'
            );
        }

        $seededAt = '2026-11-01 08:00:00';

        $events = [
            // --- Academic (4 events: 3 Upcoming, 1 Completed) ---
            [
                'title' => 'Annual Campus Hackathon',
                'description' => 'A 24-hour coding sprint where student teams build solutions for campus life and local communities.',
                'event_date_time' => '2026-11-28 09:00:00',
                'location' => 'Engineering Innovation Lab, Room 302',
                'category' => 'Academic',
                'status' => 'Upcoming',
                'capacity' => 120,
                'user_id' => $organizerOneId,
                'deleted_at' => null,
                'created_at' => $seededAt,
                'updated_at' => $seededAt,
            ],
            [
                'title' => 'Cloud & PostgreSQL Architecture Clinic',
                'description' => 'Hands-on session covering relational indexing, query tuning, and deployment workflows.',
                'event_date_time' => '2026-12-03 13:30:00',
                'location' => 'Computer Science Lecture Hall 101',
                'category' => 'Academic',
                'status' => 'Upcoming',
                'capacity' => 90,
                'user_id' => $organizerOneId,
                'deleted_at' => null,
                'created_at' => $seededAt,
                'updated_at' => $seededAt,
            ],
            [
                'title' => 'Capstone Proposal Pitch Day',
                'description' => 'Senior teams present project scopes, milestones, and technical stacks to faculty panels.',
                'event_date_time' => '2026-12-09 10:00:00',
                'location' => 'Innovation Hub Auditorium',
                'category' => 'Academic',
                'status' => 'Upcoming',
                'capacity' => 160,
                'user_id' => $organizerTwoId,
                'deleted_at' => null,
                'created_at' => $seededAt,
                'updated_at' => $seededAt,
            ],
            [
                'title' => 'Undergraduate Research Symposium',
                'description' => 'Oral and poster presentations highlighting senior capstone projects and faculty-mentored studies.',
                'event_date_time' => '2026-11-11 14:00:00',
                'location' => 'Science Auditorium B',
                'category' => 'Academic',
                'status' => 'Completed',
                'capacity' => 200,
                'user_id' => $organizerTwoId,
                'deleted_at' => null,
                'created_at' => $seededAt,
                'updated_at' => $seededAt,
            ],

            // --- Sports (4 events: 3 Upcoming, 1 Ongoing) ---
            [
                'title' => 'Inter-Departmental Basketball Cup',
                'description' => 'Elimination round games featuring varsity and intramural squads from across all colleges.',
                'event_date_time' => '2026-11-21 16:30:00',
                'location' => 'University Main Gymnasium',
                'category' => 'Sports',
                'status' => 'Ongoing',
                'capacity' => 500,
                'user_id' => $organizerOneId,
                'deleted_at' => null,
                'created_at' => $seededAt,
                'updated_at' => $seededAt,
            ],
            [
                'title' => 'Midnight 5K Fun Run',
                'description' => 'Evening campus loop run open to students, faculty, and alumni of all fitness levels.',
                'event_date_time' => '2026-12-16 20:00:00',
                'location' => 'Athletic Track Oval',
                'category' => 'Sports',
                'status' => 'Upcoming',
                'capacity' => 250,
                'user_id' => $organizerTwoId,
                'deleted_at' => null,
                'created_at' => $seededAt,
                'updated_at' => $seededAt,
            ],
            [
                'title' => 'Campus Badminton Doubles Open',
                'description' => 'Mixed and single-division doubles brackets open to students and staff.',
                'event_date_time' => '2026-12-05 08:30:00',
                'location' => 'Sports Complex Court 2',
                'category' => 'Sports',
                'status' => 'Upcoming',
                'capacity' => 80,
                'user_id' => $organizerOneId,
                'deleted_at' => null,
                'created_at' => $seededAt,
                'updated_at' => $seededAt,
            ],
            [
                'title' => 'Inter-College Volleyball Invitational',
                'description' => 'Weekend tournament rounds showcasing collegiate indoor volleyball squads.',
                'event_date_time' => '2026-12-12 15:00:00',
                'location' => 'University Main Gymnasium',
                'category' => 'Sports',
                'status' => 'Upcoming',
                'capacity' => 450,
                'user_id' => $organizerTwoId,
                'deleted_at' => null,
                'created_at' => $seededAt,
                'updated_at' => $seededAt,
            ],

            // --- Community Service (3 events: 1 Ongoing, 1 Upcoming, 1 Cancelled) ---
            [
                'title' => 'Winter Coat & Book Donation Drive',
                'description' => 'Drop-off point collecting gently used outerwear, textbooks, and school supplies for local shelters.',
                'event_date_time' => '2026-11-20 11:00:00',
                'location' => 'Main Library Lobby',
                'category' => 'Community Service',
                'status' => 'Ongoing',
                'capacity' => 100,
                'user_id' => $organizerTwoId,
                'deleted_at' => null,
                'created_at' => $seededAt,
                'updated_at' => $seededAt,
            ],
            [
                'title' => 'Campus & Neighborhood Tree Planting',
                'description' => 'Volunteer drive distributing native saplings and maintaining green zones around campus grounds.',
                'event_date_time' => '2026-12-03 07:30:00',
                'location' => 'North Quad & Botanical Walk',
                'category' => 'Community Service',
                'status' => 'Upcoming',
                'capacity' => 80,
                'user_id' => $organizerOneId,
                'deleted_at' => null,
                'created_at' => $seededAt,
                'updated_at' => $seededAt,
            ],
            [
                'title' => 'Coastal & Riverbank Cleanup Convoy',
                'description' => 'Saturday morning student volunteer trip focused on trash collection and waste sorting.',
                'event_date_time' => '2026-12-06 06:30:00',
                'location' => 'South Gate Transport Bay',
                'category' => 'Community Service',
                'status' => 'Cancelled',
                'capacity' => 110,
                'user_id' => $organizerTwoId,
                'deleted_at' => null,
                'created_at' => $seededAt,
                'updated_at' => $seededAt,
            ],

            // --- Arts & Culture (4 events: 3 Upcoming, 1 Completed) ---
            [
                'title' => 'Autumn Student Art & Photography Showcase',
                'description' => 'Exhibition of paintings, sculptures, digital prints, and short films created by student artists.',
                'event_date_time' => '2026-11-25 13:00:00',
                'location' => 'University Fine Arts Gallery',
                'category' => 'Arts & Culture',
                'status' => 'Upcoming',
                'capacity' => 150,
                'user_id' => $organizerTwoId,
                'deleted_at' => null,
                'created_at' => $seededAt,
                'updated_at' => $seededAt,
            ],
            [
                'title' => 'Open Mic Poetry & Acoustic Night',
                'description' => 'An evening of spoken word, original songs, and student performances in a casual setting.',
                'event_date_time' => '2026-11-30 18:30:00',
                'location' => 'Campus Coffeehouse Patio',
                'category' => 'Arts & Culture',
                'status' => 'Upcoming',
                'capacity' => 90,
                'user_id' => $organizerOneId,
                'deleted_at' => null,
                'created_at' => $seededAt,
                'updated_at' => $seededAt,
            ],
            [
                'title' => 'Student Short Film Screening',
                'description' => 'Curated screening of narrative shorts and documentaries followed by a director Q&A.',
                'event_date_time' => '2026-12-08 17:30:00',
                'location' => 'Media Arts Screening Room',
                'category' => 'Arts & Culture',
                'status' => 'Upcoming',
                'capacity' => 110,
                'user_id' => $organizerTwoId,
                'deleted_at' => null,
                'created_at' => $seededAt,
                'updated_at' => $seededAt,
            ],
            [
                'title' => 'Traditional Dance & Folk Ensemble Night',
                'description' => 'Cultural performances celebrating regional dances, live percussion, and traditional attire.',
                'event_date_time' => '2026-11-07 18:00:00',
                'location' => 'University Cultural Theater',
                'category' => 'Arts & Culture',
                'status' => 'Completed',
                'capacity' => 300,
                'user_id' => $organizerOneId,
                'deleted_at' => null,
                'created_at' => $seededAt,
                'updated_at' => $seededAt,
            ],

            // --- Social (3 events: 1 Upcoming, 1 Completed, 1 Cancelled) ---
            [
                'title' => 'Freshers Welcome & Club Fair',
                'description' => 'Meet student organizations, sample club activities, and enjoy live acoustics and refreshments.',
                'event_date_time' => '2026-10-31 10:00:00',
                'location' => 'Student Center Atrium',
                'category' => 'Social',
                'status' => 'Completed',
                'capacity' => 400,
                'user_id' => $organizerTwoId,
                'deleted_at' => null,
                'created_at' => $seededAt,
                'updated_at' => $seededAt,
            ],
            [
                'title' => 'Board Game & Trivia Night',
                'description' => 'Casual tabletop tournaments and team trivia rounds designed to help students unwind after midterms.',
                'event_date_time' => '2026-12-04 19:00:00',
                'location' => 'Student Union Lounge',
                'category' => 'Social',
                'status' => 'Upcoming',
                'capacity' => 75,
                'user_id' => $organizerOneId,
                'deleted_at' => null,
                'created_at' => $seededAt,
                'updated_at' => $seededAt,
            ],
            [
                'title' => 'Dormitory Bonfire & Mixer',
                'description' => 'Evening social mixer for residence hall students with snacks and lawn games.',
                'event_date_time' => '2026-12-11 19:30:00',
                'location' => 'East Residence Courtyard',
                'category' => 'Social',
                'status' => 'Cancelled',
                'capacity' => 130,
                'user_id' => $organizerOneId,
                'deleted_at' => null,
                'created_at' => $seededAt,
                'updated_at' => $seededAt,
            ],

            // --- Career & Professional (3 events: 1 Upcoming, 1 Completed, 1 Cancelled) ---
            [
                'title' => 'Tech & Finance Career Fair',
                'description' => 'Connect with recruiters for summer internships, graduate roles, and portfolio/resume reviews.',
                'event_date_time' => '2026-12-09 09:30:00',
                'location' => 'Grand Convention Hall',
                'category' => 'Career & Professional',
                'status' => 'Upcoming',
                'capacity' => 350,
                'user_id' => $organizerTwoId,
                'deleted_at' => null,
                'created_at' => $seededAt,
                'updated_at' => $seededAt,
            ],
            [
                'title' => 'LinkedIn & Technical Interview Workshop',
                'description' => 'Hands-on session covering behavioral STAR answers, coding problem breakdown, and recruiter outreach.',
                'event_date_time' => '2026-12-06 15:00:00',
                'location' => 'Career Services Seminar Room 104',
                'category' => 'Career & Professional',
                'status' => 'Cancelled',
                'capacity' => 60,
                'user_id' => $organizerOneId,
                'deleted_at' => null,
                'created_at' => $seededAt,
                'updated_at' => $seededAt,
            ],
            [
                'title' => 'Alumni Mentorship & Resume Roundtable',
                'description' => 'Small-group feedback sessions pairing graduating students with alumni industry mentors.',
                'event_date_time' => '2026-11-14 14:00:00',
                'location' => 'Alumni Relations Conference Room',
                'category' => 'Career & Professional',
                'status' => 'Completed',
                'capacity' => 70,
                'user_id' => $organizerTwoId,
                'deleted_at' => null,
                'created_at' => $seededAt,
                'updated_at' => $seededAt,
            ],
            [
                'title' => 'Internship Portfolio Critique Session',
                'description' => 'One-on-one portfolio and GitHub repository reviews for software and design applicants.',
                'event_date_time' => '2026-12-14 13:00:00',
                'location' => 'Career Services Seminar Room 102',
                'category' => 'Career & Professional',
                'status' => 'Upcoming',
                'capacity' => 50,
                'user_id' => $organizerTwoId,
                'deleted_at' => null,
                'created_at' => $seededAt,
                'updated_at' => $seededAt,
            ],
        ];

        foreach ($events as $event) {
            DB::table('events')->updateOrInsert(
                ['title' => $event['title']],
                $event
            );
        }
    }
}