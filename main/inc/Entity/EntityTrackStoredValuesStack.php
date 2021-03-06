<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * EntityTrackStoredValuesStack
 *
 * @Table(name="track_stored_values_stack")
 * @Entity
 */
class EntityTrackStoredValuesStack
{
    /**
     * @var integer
     *
     * @Column(name="id", type="integer", precision=0, scale=0, nullable=false, unique=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @Column(name="user_id", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $userId;

    /**
     * @var integer
     *
     * @Column(name="sco_id", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $scoId;

    /**
     * @var integer
     *
     * @Column(name="stack_order", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $stackOrder;

    /**
     * @var string
     *
     * @Column(name="course_id", type="string", length=40, precision=0, scale=0, nullable=false, unique=false)
     */
    private $courseId;

    /**
     * @var string
     *
     * @Column(name="sv_key", type="string", length=64, precision=0, scale=0, nullable=false, unique=false)
     */
    private $svKey;

    /**
     * @var string
     *
     * @Column(name="sv_value", type="text", precision=0, scale=0, nullable=false, unique=false)
     */
    private $svValue;


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
     * Set userId
     *
     * @param integer $userId
     * @return EntityTrackStoredValuesStack
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return integer 
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set scoId
     *
     * @param integer $scoId
     * @return EntityTrackStoredValuesStack
     */
    public function setScoId($scoId)
    {
        $this->scoId = $scoId;

        return $this;
    }

    /**
     * Get scoId
     *
     * @return integer 
     */
    public function getScoId()
    {
        return $this->scoId;
    }

    /**
     * Set stackOrder
     *
     * @param integer $stackOrder
     * @return EntityTrackStoredValuesStack
     */
    public function setStackOrder($stackOrder)
    {
        $this->stackOrder = $stackOrder;

        return $this;
    }

    /**
     * Get stackOrder
     *
     * @return integer 
     */
    public function getStackOrder()
    {
        return $this->stackOrder;
    }

    /**
     * Set courseId
     *
     * @param string $courseId
     * @return EntityTrackStoredValuesStack
     */
    public function setCourseId($courseId)
    {
        $this->courseId = $courseId;

        return $this;
    }

    /**
     * Get courseId
     *
     * @return string 
     */
    public function getCourseId()
    {
        return $this->courseId;
    }

    /**
     * Set svKey
     *
     * @param string $svKey
     * @return EntityTrackStoredValuesStack
     */
    public function setSvKey($svKey)
    {
        $this->svKey = $svKey;

        return $this;
    }

    /**
     * Get svKey
     *
     * @return string 
     */
    public function getSvKey()
    {
        return $this->svKey;
    }

    /**
     * Set svValue
     *
     * @param string $svValue
     * @return EntityTrackStoredValuesStack
     */
    public function setSvValue($svValue)
    {
        $this->svValue = $svValue;

        return $this;
    }

    /**
     * Get svValue
     *
     * @return string 
     */
    public function getSvValue()
    {
        return $this->svValue;
    }
}
