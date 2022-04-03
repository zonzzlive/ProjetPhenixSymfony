<?php

namespace App\Entity;

use App\Entity\Status;
use App\Repository\ProjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjectRepository::class)]
class Project
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $description;

    #[ORM\Column(type: 'date', nullable: true)]
    private $endedAt;

    #[ORM\Column(type: 'date', nullable: true)]
    private $createdAt;

    #[ORM\ManyToOne(targetEntity: Status::class, inversedBy: 'projects')]
    private $status;

    #[ORM\Column(type: 'string', length: 255)]
    private $code;

    #[ORM\ManyToOne(targetEntity: Portfolio::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $portfolio;

    #[ORM\ManyToOne(targetEntity: Team::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $teamProject;

    #[ORM\ManyToOne(targetEntity: Team::class, inversedBy: 'teamProject')]
    private $TeamProject;

    #[ORM\ManyToOne(targetEntity: Team::class)]
    private $clientTeam;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $startBudget;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $consBudget;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $toDoBudget;

    #[ORM\Column(type: 'boolean')]
    private $archive;

    #[ORM\OneToMany(mappedBy: 'project', targetEntity: Risk::class, orphanRemoval: true)]
    private $risks;

    public function __construct()
    {
        $this->project = new ArrayCollection();
        $this->risks = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getEndedAt(): ?\DateTimeInterface
    {
        return $this->endedAt;
    }

    public function setEndedAt(?\DateTimeInterface $endedAt): self
    {
        $this->endedAt = $endedAt;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getstatus(): ?Status
    {
        return $this->status;
    }

    public function setstatus(?Status $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getPortfolio(): ?Portfolio
    {
        return $this->portfolio;
    }

    public function setPortfolio(?Portfolio $portfolio): self
    {
        $this->portfolio = $portfolio;

        return $this;
    }

    public function getTeamProject(): ?Team
    {
        return $this->TeamProject;
    }

    public function setTeamProject(?Team $TeamProject): self
    {
        $this->TeamProject = $TeamProject;

        return $this;
    }

    public function getClientTeam(): ?Team
    {
        return $this->clientTeam;
    }

    public function setClientTeam(?Team $clientTeam): self
    {
        $this->clientTeam = $clientTeam;

        return $this;
    }

    public function getStartBudget(): ?int
    {
        return $this->startBudget;
    }

    public function setStartBudget(?int $startBudget): self
    {
        $this->startBudget = $startBudget;

        return $this;
    }

    public function getConsBudget(): ?int
    {
        return $this->consBudget;
    }

    public function setConsBudget(?int $consBudget): self
    {
        $this->consBudget = $consBudget;

        return $this;
    }

    public function getToDoBudget(): ?int
    {
        return $this->toDoBudget;
    }

    public function setToDoBudget(?int $toDoBudget): self
    {
        $this->toDoBudget = $toDoBudget;

        return $this;
    }

    public function getArchive(): ?bool
    {
        return $this->archive;
    }

    public function setArchive(bool $archive): self
    {
        $this->archive = $archive;

        return $this;
    }

    /**
     * @return Collection|Risk[]
     */
    public function getRisks(): Collection
    {
        return $this->risks;
    }

    public function addRisk(Risk $risk): self
    {
        if (!$this->risks->contains($risk)) {
            $this->risks[] = $risk;
            $risk->setProject($this);
        }

        return $this;
    }

    public function removeRisk(Risk $risk): self
    {
        if ($this->risks->removeElement($risk)) {
            // set the owning side to null (unless already changed)
            if ($risk->getProject() === $this) {
                $risk->setProject(null);
            }
        }

        return $this;
    }
}
