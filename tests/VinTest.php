<?php declare(strict_types=1);

namespace CRASSQ\Vin\Tests;

/**
 * Import classes
 */
use PHPUnit\Framework\TestCase;
use CRASSQ\Vin\Vin;
use CRASSQ\Vin\VinInterface;

/**
 * VinTest
 */
class VinTest extends TestCase
{

    /**
     * @var string
     */
    private const TEST_VIN = 'WVWZZZ1KZ6W612305';

    /**
     * @var string
     */
    private const TEST_VIN_WITH_UNKNOWN_REGION = 'GVWZZZ1KZ6W612305';

    /**
     * @var string
     */
    private const TEST_VIN_WITH_UNKNOWN_COUNTRY = 'AZWZZZ1KZ6W612305';

    /**
     * @var string
     */
    private const TEST_VIN_WITH_UNKNOWN_MANUFACTURER = 'ZZZZZZ1KZ6W612305';

    /**
     * @var string
     */
    private const TEST_VIN_WITH_UNKNOWN_MODEL_YEAR = 'WVWZZZ1KZZW612305';

    /**
     * @var string
     */
    private const TEST_VIN_WITH_SINGLE_MODEL_YEAR = 'WVWZZZ1KZ6W612305';

    /**
     * @var string
     */
    private const TEST_VIN_WITH_MULTIPLE_MODEL_YEAR = 'WVWZZZ1KZAW612305';

    /**
     * @var string
     */
    private const TEST_VIN_WITH_FUTURITY_MODEL_YEAR = 'WVWZZZ1KZYW612305';

    /**
     * @return void
     */
    public function testConstructor() : void
    {
        $vin = new Vin(self::TEST_VIN);

        $this->assertInstanceOf(VinInterface::class, $vin);
    }

    /**
     * @return void
     */
    public function testVinLessThan17Characters() : void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('The value "AAAAAAAAAAAAAAAA" is not a valid VIN');

        new Vin(\str_repeat('A', 16));
    }

    /**
     * @return void
     */
    public function testVinMoreThan17Characters() : void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('The value "AAAAAAAAAAAAAAAAAA" is not a valid VIN');

        new Vin(\str_repeat('A', 18));
    }

    /**
     * @dataProvider vinForbiddenCharactersProvider
     *
     * @return void
     */
    public function testVinWithForbiddenCharacters($value) : void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(\sprintf('The value "AAAAAAAAAAAAAAAA%s" is not a valid VIN', $value));

        new Vin(\str_repeat('A', 16) . $value);
    }

    /**
     * @return void
     */
    public function testGetVin() : void
    {
        $vin = new Vin(self::TEST_VIN);

        $this->assertSame(self::TEST_VIN, $vin->getVin());
    }

    /**
     * @return void
     */
    public function testGetWmi() : void
    {
        $vin = new Vin(self::TEST_VIN);

        $this->assertSame(\substr(self::TEST_VIN, 0, 3), $vin->getWmi());
    }

    /**
     * @return void
     */
    public function testGetVds() : void
    {
        $vin = new Vin(self::TEST_VIN);

        $this->assertSame(\substr(self::TEST_VIN, 3, 6), $vin->getVds());
    }

    /**
     * @return void
     */
    public function testGetVis() : void
    {
        $vin = new Vin(self::TEST_VIN);

        $this->assertSame(\substr(self::TEST_VIN, 9, 8), $vin->getVis());
    }

    /**
     * @return void
     */
    public function testGetRegion() : void
    {
        $vin = new Vin(self::TEST_VIN);

        $this->assertSame('Europe', $vin->getRegion());
    }

    /**
     * @return void
     */
    public function testGetCountry() : void
    {
        $vin = new Vin(self::TEST_VIN);

        $this->assertSame('Germany', $vin->getCountry());
    }

    /**
     * @return void
     */
    public function testGetManufacturer() : void
    {
        $vin = new Vin(self::TEST_VIN);

        $this->assertSame('Volkswagen', $vin->getManufacturer());
    }

    /**
     * @return void
     */
    public function testGetModelYear() : void
    {
        $vin = new Vin(self::TEST_VIN);

        $this->assertSame([2006], $vin->getModelYear());
    }

    /**
     * @return void
     */
    public function testToArray() : void
    {
        $vin = new Vin(self::TEST_VIN);

        $this->assertSame([
            'vin' => self::TEST_VIN,
            'wmi' => \substr(self::TEST_VIN, 0, 3),
            'vds' => \substr(self::TEST_VIN, 3, 6),
            'vis' => \substr(self::TEST_VIN, 9, 8),
            'region' => 'Europe',
            'country' => 'Germany',
            'manufacturer' => 'Volkswagen',
            'modelYear' => [2006],
        ], $vin->toArray());
    }

    /**
     * @return array
     */
    public function vinForbiddenCharactersProvider() : array
    {
        return [
            ['I'],
            ['O'],
            ['Q'],
        ];
    }

    /**
     * @return void
     */
    public function testUnknownRegion() : void
    {
        $vin = new Vin(self::TEST_VIN_WITH_UNKNOWN_REGION);

        $this->assertNull($vin->getRegion());
    }

    /**
     * @return void
     */
    public function testUnknownCountry() : void
    {
        $vin = new Vin(self::TEST_VIN_WITH_UNKNOWN_COUNTRY);

        $this->assertNull($vin->getCountry());
    }

    /**
     * @return void
     */
    public function testUnknownManufacturer() : void
    {
        $vin = new Vin(self::TEST_VIN_WITH_UNKNOWN_MANUFACTURER);

        $this->assertNull($vin->getManufacturer());
    }

    /**
     * @return void
     */
    public function testUnknownModelYear() : void
    {
        $vin = new Vin(self::TEST_VIN_WITH_UNKNOWN_MODEL_YEAR);

        $this->assertSame([], $vin->getModelYear());
    }

    /**
     * @return void
     */
    public function testSingleModelYear() : void
    {
        $vin = new Vin(self::TEST_VIN_WITH_SINGLE_MODEL_YEAR);

        $this->assertSame([2006], $vin->getModelYear());
    }

    /**
     * @return void
     */
    public function testMultipleModelYear() : void
    {
        $vin = new Vin(self::TEST_VIN_WITH_MULTIPLE_MODEL_YEAR);

        $this->assertSame([1980, 2010], $vin->getModelYear());
    }

    /**
     * @return void
     */
    public function testFuturityModelYear() : void
    {
        $vin = new Vin(self::TEST_VIN_WITH_FUTURITY_MODEL_YEAR);

        $this->assertSame([2000], $vin->getModelYear());
    }

    /**
     * @return void
     */
    public function testToString() : void
    {
        $vin = new Vin(self::TEST_VIN_WITH_FUTURITY_MODEL_YEAR);

        $this->assertSame(self::TEST_VIN_WITH_FUTURITY_MODEL_YEAR, (string) $vin);
    }
}
