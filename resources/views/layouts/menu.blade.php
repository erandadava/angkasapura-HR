<!-- <li class="{{ Request::is('users*') ? 'active' : '' }}">
    <a href="{!! route('users.index') !!}"><i class="fa fa-edit"></i><span>Users</span></a>
</li> -->
<li class="{{ Request::is('users*') ? 'active' : '' }}">
    <a href="{!! route('users.index') !!}"><i class="fa fa-edit"></i><span>Users</span></a>
</li>

<li class="{{ Request::is('fungsis*') ? 'active' : '' }}">
    <a href="{!! route('fungsis.index') !!}"><i class="fa fa-edit"></i><span>Fungsi</span></a>
</li>

<li class="{{ Request::is('jabatans*') ? 'active' : '' }}">
    <a href="{!! route('jabatans.index') !!}"><i class="fa fa-edit"></i><span>Jabatan</span></a>
</li>

<li class="{{ Request::is('karyawans*') ? 'active' : '' }}">
    <a href="{!! route('karyawans.index') !!}"><i class="fa fa-edit"></i><span>Karyawan</span></a>
</li>

<li class="{{ Request::is('klsjabatans*') ? 'active' : '' }}">
    <a href="{!! route('klsjabatans.index') !!}"><i class="fa fa-edit"></i><span>Kelas jabatan</span></a>
</li>

<li class="{{ Request::is('osdocs*') ? 'active' : '' }}">
    <a href="{!! route('osdocs.index') !!}"><i class="fa fa-edit"></i><span>Os Doc</span></a>
</li>

<li class="{{ Request::is('statuskars*') ? 'active' : '' }}">
    <a href="{!! route('statuskars.index') !!}"><i class="fa fa-edit"></i><span>Status Karyawan</span></a>
</li>

<li class="{{ Request::is('tipekars*') ? 'active' : '' }}">
    <a href="{!! route('tipekars.index') !!}"><i class="fa fa-edit"></i><span>Tipe Karyawan</span></a>
</li>

<li class="{{ Request::is('units*') ? 'active' : '' }}">
    <a href="{!! route('units.index') !!}"><i class="fa fa-edit"></i><span>Unit</span></a>
</li>

<li class="{{ Request::is('unitkerjas*') ? 'active' : '' }}">
    <a href="{!! route('unitkerjas.index') !!}"><i class="fa fa-edit"></i><span>Unit Kerja</span></a>
</li>

<li class="{{ Request::is('users*') ? '' : '' }}">
    <a href="#"><i class="fa fa-edit"></i><span>Komposisi Karyawan</span></a>
</li>

<li class="{{ Request::is('unitkerjas.formasiexisting') ? '' : '' }}">
    <a href="/formasiexisting"><i class="fa fa-edit"></i><span>Formasi vs Eksisting</span></a>
</li>
<!-- 
<li class="{{ Request::is('users*') ? '' : '' }}">
    <a href="#"><i class="fa fa-edit"></i><span>Jabatan Lowong Manajerial</span></a>
</li>
<li class="{{ Request::is('users*') ? '' : '' }}">
    <a href="#"><i class="fa fa-edit"></i><span>Rekap MPP Manajerial</span></a>
</li>
<li class="{{ Request::is('users*') ? '' : '' }}">
    <a href="#"><i class="fa fa-edit"></i><span>Rekap Jumlah Perfungsi</span></a>
</li>
<li class="{{ Request::is('users*') ? '' : '' }}">
    <a href="#"><i class="fa fa-edit"></i><span>Data Eksisting Manajerial</span></a>
</li>
<li class="{{ Request::is('users*') ? '' : '' }}">
    <a href="#"><i class="fa fa-edit"></i><span>Performance OS</span></a>
</li> -->
<li class="{{ Request::is('roles*') ? 'active' : '' }}">
    <a href="{!! route('roles.index') !!}"><i class="fa fa-edit"></i><span>Roles</span></a>
</li>

<li class="{{ Request::is('mpp*') ? 'active' : '' }}">
    <a href="{!! route('mpp.index') !!}"><i class="fa fa-edit"></i><span>MPP</span></a>
</li><li class="{{ Request::is('karyawanOs*') ? 'active' : '' }}">
    <a href="{!! route('karyawanOs.index') !!}"><i class="fa fa-edit"></i><span>Karyawan Outsourcing</span></a>
</li>

<li class="{{ Request::is('osperformances*') ? 'active' : '' }}">
    <a href="{!! route('osperformances.index') !!}"><i class="fa fa-edit"></i><span>OS Performance</span></a>
</li>

