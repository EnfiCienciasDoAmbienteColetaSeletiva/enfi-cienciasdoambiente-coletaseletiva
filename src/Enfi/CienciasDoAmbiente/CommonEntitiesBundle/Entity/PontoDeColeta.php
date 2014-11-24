<?php

namespace Enfi\CienciasDoAmbiente\CommonEntitiesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PontoDeColeta
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Enfi\CienciasDoAmbiente\CommonEntitiesBundle\Entity\PontoDeColetaRepository")
 */
class PontoDeColeta
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_fixo", type="integer")
     */
    private $idFixo;

    /**
     * @var integer
     *
     * @ORM\Column(name="revision", type="integer")
     */
    private $revision;

    /**
     * @var integer
     *
     * @ORM\Column(name="ativo", type="smallint")
     */
    private $ativo;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="text")
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="endereco", type="text")
     */
    private $endereco;

    /**
     * @var string
     *
     * @ORM\Column(name="telefone", type="string", length=255, nullable=true)
     */
    private $telefone;

    /**
     * @var string
     *
     * @ORM\Column(name="horarioDeFuncionamento", type="text", nullable=true)
     */
    private $horarioDeFuncionamento;

    /**
     * @var string
     *
     * @ORM\Column(name="latitude", type="float")
     */
    private $latitude;

    /**
     * @var float
     *
     * @ORM\Column(name="longitude", type="float")
     */
    private $longitude;

    /**
     * @var integer
     *
     * @ORM\Column(name="usuario_id", type="integer")
     */
    private $usuarioId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="timestamp", type="datetimetz")
     */
    private $timestamp;

    /**
     * @var string
     *
     * @ORM\Column(name="descricaoDasModificacoes", type="text")
     */
    private $descricaoDasModificacoes;

    /**
     * @var string
     *
     * @ORM\Column(name="informacoesAdicionais", type="text", nullable=true)
     */
    private $informacoesAdicionais;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set idFixo
     *
     * @param integer $idFixo
     * @return PontoDeColeta
     */
    public function setIdFixo($idFixo)
    {
        $this->idFixo = $idFixo;

        return $this;
    }

    /**
     * Get idFixo
     *
     * @return integer 
     */
    public function getIdFixo()
    {
        return $this->idFixo;
    }

    /**
     * Set revision
     *
     * @param integer $revision
     * @return PontoDeColeta
     */
    public function setRevision($revision)
    {
        $this->revision = $revision;

        return $this;
    }

    /**
     * Get revision
     *
     * @return integer 
     */
    public function getRevision()
    {
        return $this->revision;
    }

    /**
     * Set ativo
     *
     * @param integer $ativo
     * @return PontoDeColeta
     */
    public function setAtivo($ativo)
    {
        $this->ativo = $ativo;

        return $this;
    }

    /**
     * Get ativo
     *
     * @return integer 
     */
    public function getAtivo()
    {
        return $this->ativo;
    }

    /**
     * Set nome
     *
     * @param string $nome
     * @return PontoDeColeta
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get nome
     *
     * @return string 
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set endereco
     *
     * @param string $endereco
     * @return PontoDeColeta
     */
    public function setEndereco($endereco)
    {
        $this->endereco = $endereco;

        return $this;
    }

    /**
     * Get endereco
     *
     * @return string 
     */
    public function getEndereco()
    {
        return $this->endereco;
    }

    /**
     * Set telefone
     *
     * @param string $telefone
     * @return PontoDeColeta
     */
    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;

        return $this;
    }

    /**
     * Get telefone
     *
     * @return string 
     */
    public function getTelefone()
    {
        return $this->telefone;
    }

    /**
     * Set horarioDeFuncionamento
     *
     * @param string $horarioDeFuncionamento
     * @return PontoDeColeta
     */
    public function setHorarioDeFuncionamento($horarioDeFuncionamento)
    {
        $this->horarioDeFuncionamento = $horarioDeFuncionamento;

        return $this;
    }

    /**
     * Get horarioDeFuncionamento
     *
     * @return string 
     */
    public function getHorarioDeFuncionamento()
    {
        return $this->horarioDeFuncionamento;
    }

    /**
     * Set latitude
     *
     * @param string $latitude
     * @return PontoDeColeta
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return string 
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set longitude
     *
     * @param float $longitude
     * @return PontoDeColeta
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return float 
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set usuarioId
     *
     * @param integer $usuarioId
     * @return PontoDeColeta
     */
    public function setUsuarioId($usuarioId)
    {
        $this->usuarioId = $usuarioId;

        return $this;
    }

    /**
     * Get usuarioId
     *
     * @return integer 
     */
    public function getUsuarioId()
    {
        return $this->usuarioId;
    }

    /**
     * Set timestamp
     *
     * @param \DateTime $timestamp
     * @return PontoDeColeta
     */
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    /**
     * Get timestamp
     *
     * @return \DateTime 
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * Set descricaoDasModificacoes
     *
     * @param string $descricaoDasModificacoes
     * @return PontoDeColeta
     */
    public function setDescricaoDasModificacoes($descricaoDasModificacoes)
    {
        $this->descricaoDasModificacoes = $descricaoDasModificacoes;

        return $this;
    }

    /**
     * Get descricaoDasModificacoes
     *
     * @return string 
     */
    public function getDescricaoDasModificacoes()
    {
        return $this->descricaoDasModificacoes;
    }

    /**
     * Set informacoesAdicionais
     *
     * @param string $informacoesAdicionais
     * @return PontoDeColeta
     */
    public function setInformacoesAdicionais($informacoesAdicionais)
    {
        $this->informacoesAdicionais = $informacoesAdicionais;

        return $this;
    }

    /**
     * Get informacoesAdicionais
     *
     * @return string 
     */
    public function getInformacoesAdicionais()
    {
        return $this->informacoesAdicionais;
    }
}
