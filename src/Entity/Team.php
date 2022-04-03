<?php

namespace App\Entity;

use App\Repository\TeamRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TeamRepository::class)]
class Team
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $teamLeader;

    #[ORM\OneToMany(mappedBy: 'team', targetEntity: TeamMembre::class, orphanRemoval: true)]
    private $user;

    #[ORM\OneToMany(mappedBy: 'TeamProject', targetEntity: Project::class)]
    private $teamProject;

    public function __construct()
    {
        $this->user = new ArrayCollection();
        $this->teamProject = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getTeamLeader(): ?User
    {
        return $this->teamLeader;
    }

    public function setTeamLeader(?User $teamLeader): self
    {
        $this->teamLeader = $teamLeader;

        return $this;
    }

    /**
     * @return Collection|TeamMembre[]
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    public function addUser(TeamMembre $user): self
    {
        if (!$this->user->contains($user)) {
            $this->user[] = $user;
            $user->setTeam($this);
        }

        return $this;
    }

    public function removeUser(TeamMembre $user): self
    {
        if ($this->user->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getTeam() === $this) {
                $user->setTeam(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Project[]
     */
    public function getTeamProject(): Collection
    {
        return $this->teamProject;
    }

    public function addTeamProject(Project $teamProject): self
    {
        if (!$this->teamProject->contains($teamProject)) {
            $this->teamProject[] = $teamProject;
            $teamProject->setTeamProject($this);
        }

        return $this;
    }

    public function removeTeamProject(Project $teamProject): self
    {
        if ($this->teamProject->removeElement($teamProject)) {
            // set the owning side to null (unless already changed)
            if ($teamProject->getTeamProject() === $this) {
                $teamProject->setTeamProject(null);
            }
        }

        return $this;
    }
}
