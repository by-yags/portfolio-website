<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class HomePage extends Component
{
    public $user;
    public $repos;
    public $readmeSections = [];

    public function mount()
    {
        $this->user = Http::get('https://api.github.com/users/by-yags')->json();
        $this->repos = Http::get('https://api.github.com/users/by-yags/repos')->json();

        $readmeContent = Http::get('https://raw.githubusercontent.com/by-yags/by-yags/main/README.md')->body();
        $this->readmeSections = $this->parseReadme($readmeContent);
    }

    private function parseReadme($content)
    {
        $sections = [];
        $currentSection = null;
        $lines = explode("\n", $content);

        foreach ($lines as $line) {
            if (str_starts_with($line, '## ')) {
                $currentSection = trim(str_replace('## ', '', $line));
                $sections[$currentSection] = [];
            } elseif ($currentSection && trim($line) !== '') {
                $sections[$currentSection][] = $line;
            }
        }

        return $sections;
    }

    public function render()
    {
        return view('livewire.home-page');
    }
}
